<?php
require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '/career_progress_lib.php';

header('Content-Type: text/plain; charset=UTF-8');

function run_ddl($conn, $sql, $label)
{
    if (!mysqli_query($conn, $sql)) {
        throw new Exception($label . ': ' . mysqli_error($conn));
    }
    echo "[OK] " . $label . PHP_EOL;
}

try {
    echo "Starting career migration..." . PHP_EOL;
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0");
    mysqli_begin_transaction($conn);

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS backup_cpo_usermaster_career AS SELECT * FROM cpo_usermaster", "Backup cpo_usermaster");
    run_ddl($conn, "CREATE TABLE IF NOT EXISTS backup_cpo_uploadfiles_career AS SELECT * FROM cpo_uploadfiles", "Backup cpo_uploadfiles");
    run_ddl($conn, "CREATE TABLE IF NOT EXISTS backup_cpo_uploadfilestutor_career AS SELECT * FROM cpo_uploadfilestutor", "Backup cpo_uploadfilestutor");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_assessments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        current_status VARCHAR(100) NOT NULL,
        current_status_other VARCHAR(255) NULL,
        qualifications_text TEXT NULL,
        skills_json TEXT NOT NULL,
        skills_other VARCHAR(255) NULL,
        career_interests TEXT NOT NULL,
        employment_goals TEXT NOT NULL,
        barriers_json TEXT NOT NULL,
        barriers_other VARCHAR(255) NULL,
        created_at DATETIME NOT NULL,
        updated_at DATETIME NULL,
        UNIQUE KEY uq_career_assessment_user (user_id)
    ) ENGINE=InnoDB", "Create career_assessments");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_mentors (
        iUserId INT PRIMARY KEY,
        is_active TINYINT(1) NOT NULL DEFAULT 1,
        last_assigned_at DATETIME NULL,
        created_at DATETIME NOT NULL,
        updated_at DATETIME NULL
    ) ENGINE=InnoDB", "Create career_mentors");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_mentor_assignments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        mentor_id INT NOT NULL,
        assigned_at DATETIME NOT NULL,
        assignment_method VARCHAR(50) NOT NULL DEFAULT 'round_robin'
    ) ENGINE=InnoDB", "Create career_mentor_assignments");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_discovery_sessions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        mentor_id INT NOT NULL,
        summary TEXT NULL,
        private_notes TEXT NULL,
        created_at DATETIME NOT NULL
    ) ENGINE=InnoDB", "Create career_discovery_sessions");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_milestone_templates (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NULL,
        default_tokens INT NOT NULL DEFAULT 1,
        is_active TINYINT(1) NOT NULL DEFAULT 1
    ) ENGINE=InnoDB", "Create career_milestone_templates");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_plans (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        mentor_id INT NULL,
        title VARCHAR(255) NOT NULL DEFAULT 'Career Plan',
        created_at DATETIME NOT NULL,
        updated_at DATETIME NULL
    ) ENGINE=InnoDB", "Create career_plans");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_plan_milestones (
        id INT AUTO_INCREMENT PRIMARY KEY,
        plan_id INT NOT NULL,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT NULL,
        target_date DATE NULL,
        token_value INT NOT NULL DEFAULT 1,
        bonus_tokens INT NOT NULL DEFAULT 0,
        required_evidence VARCHAR(255) NULL,
        status ENUM('not_started','in_progress','completed') NOT NULL DEFAULT 'not_started',
        completed_at DATETIME NULL
    ) ENGINE=InnoDB", "Create career_plan_milestones");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_weekly_tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        milestone_id INT NOT NULL,
        user_id INT NOT NULL,
        task_title VARCHAR(255) NOT NULL,
        week_start DATE NOT NULL,
        week_end DATE NOT NULL,
        status ENUM('not_started','in_progress','completed') NOT NULL DEFAULT 'not_started',
        token_value INT NOT NULL DEFAULT 1,
        completed_at DATETIME NULL
    ) ENGINE=InnoDB", "Create career_weekly_tasks");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_weekly_logs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task_id INT NULL,
        user_id INT NOT NULL,
        mentor_id INT NULL,
        activity_description TEXT NOT NULL,
        skills_json TEXT NULL,
        confidence_level TINYINT NOT NULL DEFAULT 3,
        staff_notes TEXT NULL,
        token_award INT NOT NULL DEFAULT 0,
        created_at DATETIME NOT NULL
    ) ENGINE=InnoDB", "Create career_weekly_logs");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_token_ledger (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        source_type VARCHAR(50) NOT NULL,
        source_id INT NULL,
        tokens INT NOT NULL,
        notes VARCHAR(255) NULL,
        created_at DATETIME NOT NULL
    ) ENGINE=InnoDB", "Create career_token_ledger");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_achievements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        token_threshold INT NOT NULL,
        description VARCHAR(255) NULL
    ) ENGINE=InnoDB", "Create career_achievements");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_user_achievements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        achievement_id INT NOT NULL,
        unlocked_at DATETIME NOT NULL
    ) ENGINE=InnoDB", "Create career_user_achievements");

    run_ddl($conn, "CREATE TABLE IF NOT EXISTS career_legacy_uploads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        source_table VARCHAR(60) NOT NULL,
        source_id INT NOT NULL,
        user_id INT NULL,
        mentor_id INT NULL,
        file_name VARCHAR(255) NOT NULL,
        original_path VARCHAR(500) NULL,
        archive_path VARCHAR(500) NULL,
        uploaded_at DATETIME NULL,
        expires_at DATETIME NULL,
        delete_confirmed TINYINT(1) NOT NULL DEFAULT 0,
        created_at DATETIME NOT NULL
    ) ENGINE=InnoDB", "Create career_legacy_uploads");

    if (!career_column_exists($conn, 'career_assessments', 'qualifications_text')) {
        run_ddl($conn, "ALTER TABLE career_assessments ADD COLUMN qualifications_text TEXT NULL", "Add career_assessments.qualifications_text");
    }
    if (!career_column_exists($conn, 'career_assessments', 'career_interests')) {
        run_ddl($conn, "ALTER TABLE career_assessments ADD COLUMN career_interests TEXT NOT NULL DEFAULT ''", "Add career_assessments.career_interests");
    }
    if (!career_column_exists($conn, 'career_assessments', 'employment_goals')) {
        run_ddl($conn, "ALTER TABLE career_assessments ADD COLUMN employment_goals TEXT NOT NULL DEFAULT ''", "Add career_assessments.employment_goals");
    }

    if (!career_column_exists($conn, 'cpo_usermaster', 'career_assessment_completed')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_assessment_completed TINYINT(1) NULL DEFAULT 0", "Add career_assessment_completed");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_mentor_id')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_mentor_id INT NULL", "Add career_mentor_id");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_pathway')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_pathway VARCHAR(50) NULL DEFAULT NULL COMMENT 'job_ready, skills_development, etc.'", "Add career_pathway");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_initial_coaching_completed')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_initial_coaching_completed TINYINT(1) NOT NULL DEFAULT 0", "Add career_initial_coaching_completed");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_pathway_assigned_at')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_pathway_assigned_at DATETIME NULL DEFAULT NULL", "Add career_pathway_assigned_at");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_stage2_qualifications_experience')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_stage2_qualifications_experience TEXT NULL", "Add career_stage2_qualifications_experience");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_stage2_skills_gaps')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_stage2_skills_gaps TEXT NULL", "Add career_stage2_skills_gaps");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_stage2_confidence_level')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_stage2_confidence_level TINYINT NULL DEFAULT NULL", "Add career_stage2_confidence_level");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_stage2_employment_readiness')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_stage2_employment_readiness VARCHAR(50) NULL DEFAULT NULL", "Add career_stage2_employment_readiness");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_stage2_goal_clarity')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_stage2_goal_clarity VARCHAR(50) NULL DEFAULT NULL", "Add career_stage2_goal_clarity");
    }
    if (!career_column_exists($conn, 'cpo_usermaster', 'career_stage2_barriers')) {
        run_ddl($conn, "ALTER TABLE cpo_usermaster ADD COLUMN career_stage2_barriers TEXT NULL", "Add career_stage2_barriers");
    }

    $seedTemplates = array(
        array('Create CV', 'Build and finalise a professional CV.', 5),
        array('Attend CV workshop', 'Join an employability CV workshop.', 4),
        array('Attend interview skills workshop', 'Practice interview preparation skills.', 4),
        array('Complete mock interview', 'Complete a mock interview with feedback.', 6),
        array('Apply for 5 jobs', 'Submit five suitable job applications.', 7),
        array('Attend training course', 'Complete relevant training.', 6),
        array('Complete AI work experience presentation', 'Present final AI-assisted business project.', 10)
    );
    foreach ($seedTemplates as $tmp) {
        $title = mysqli_real_escape_string($conn, $tmp[0]);
        $desc = mysqli_real_escape_string($conn, $tmp[1]);
        $tok = (int) $tmp[2];
        mysqli_query($conn, "INSERT INTO career_milestone_templates (title,description,default_tokens,is_active)
            SELECT '" . $title . "','" . $desc . "'," . $tok . ",1
            WHERE NOT EXISTS (SELECT 1 FROM career_milestone_templates WHERE title='" . $title . "')");
    }

    $seedAchievements = array(
        array('Getting Started', 10, 'Completed your first progress steps.'),
        array('Momentum Builder', 30, 'Built consistent career progression.'),
        array('Readiness Rising', 60, 'Demonstrated strong employability growth.'),
        array('Work Ready', 90, 'Reached a high readiness score.')
    );
    foreach ($seedAchievements as $ach) {
        $name = mysqli_real_escape_string($conn, $ach[0]);
        $thr = (int) $ach[1];
        $desc = mysqli_real_escape_string($conn, $ach[2]);
        mysqli_query($conn, "INSERT INTO career_achievements (name, token_threshold, description)
            SELECT '" . $name . "'," . $thr . ",'" . $desc . "'
            WHERE NOT EXISTS (SELECT 1 FROM career_achievements WHERE name='" . $name . "')");
    }

    $expiry = date('Y-m-d H:i:s', strtotime('+90 days'));
    $now = date('Y-m-d H:i:s');
    mysqli_query($conn, "INSERT INTO career_legacy_uploads (source_table, source_id, user_id, file_name, original_path, archive_path, uploaded_at, expires_at, created_at)
        SELECT 'cpo_uploadfiles', iFileId, iUserId, vFilePath, CONCAT('lms/uploads/',iUserId,'/',vFilePath), CONCAT('/uploads/archive/',iUserId,'/',vFilePath), vUploadDate, '" . $expiry . "', '" . $now . "'
        FROM cpo_uploadfiles u
        WHERE NOT EXISTS (SELECT 1 FROM career_legacy_uploads c WHERE c.source_table='cpo_uploadfiles' AND c.source_id=u.iFileId)");

    mysqli_query($conn, "INSERT INTO career_legacy_uploads (source_table, source_id, user_id, mentor_id, file_name, original_path, archive_path, uploaded_at, expires_at, created_at)
        SELECT 'cpo_uploadfilestutor', iFileId, NULL, iTutorId, vFilePath, CONCAT('tutorapp/uploads/',vFilePath), CONCAT('/uploads/archive/tutor/',vFilePath), vUploadDate, '" . $expiry . "', '" . $now . "'
        FROM cpo_uploadfilestutor t
        WHERE NOT EXISTS (SELECT 1 FROM career_legacy_uploads c WHERE c.source_table='cpo_uploadfilestutor' AND c.source_id=t.iFileId)");

    mysqli_commit($conn);
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
    echo "Career migration completed successfully." . PHP_EOL;
} catch (Throwable $e) {
    mysqli_rollback($conn);
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=1");
    http_response_code(500);
    echo "Migration failed: " . $e->getMessage() . PHP_EOL;
}
