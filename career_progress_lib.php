<?php
if (!function_exists('career_table_exists')) {
    function career_table_exists($conn, $tableName)
    {
        $safe = mysqli_real_escape_string($conn, $tableName);
        $sql = "SHOW TABLES LIKE '" . $safe . "'";
        $res = mysqli_query($conn, $sql);
        return $res && mysqli_num_rows($res) > 0;
    }
}

if (!function_exists('career_column_exists')) {
    function career_column_exists($conn, $tableName, $columnName)
    {
        $safeTable = mysqli_real_escape_string($conn, $tableName);
        $safeCol = mysqli_real_escape_string($conn, $columnName);
        $sql = "SHOW COLUMNS FROM `" . $safeTable . "` LIKE '" . $safeCol . "'";
        $res = mysqli_query($conn, $sql);
        return $res && mysqli_num_rows($res) > 0;
    }
}

if (!function_exists('career_usermaster_career_columns_ready')) {
    function career_usermaster_career_columns_ready($conn)
    {
        return career_column_exists($conn, 'cpo_usermaster', 'career_assessment_completed')
            && career_column_exists($conn, 'cpo_usermaster', 'career_mentor_id');
    }
}

if (!function_exists('career_coaching_stage2_columns_ready')) {
    function career_coaching_stage2_columns_ready($conn)
    {
        return career_column_exists($conn, 'cpo_usermaster', 'career_pathway')
            && career_column_exists($conn, 'cpo_usermaster', 'career_initial_coaching_completed');
    }
}

if (!function_exists('career_coaching_stage2_assessment_columns_ready')) {
    function career_coaching_stage2_assessment_columns_ready($conn)
    {
        return career_column_exists($conn, 'cpo_usermaster', 'career_stage2_qualifications_experience')
            && career_column_exists($conn, 'cpo_usermaster', 'career_stage2_skills_gaps')
            && career_column_exists($conn, 'cpo_usermaster', 'career_stage2_confidence_level')
            && career_column_exists($conn, 'cpo_usermaster', 'career_stage2_employment_readiness')
            && career_column_exists($conn, 'cpo_usermaster', 'career_stage2_goal_clarity')
            && career_column_exists($conn, 'cpo_usermaster', 'career_stage2_barriers');
    }
}

if (!function_exists('career_pathway_slugs')) {
    function career_pathway_slugs()
    {
        return array(
            'job_ready' => 'Job Ready',
            'skills_development' => 'Skills Development',
            'confidence_building' => 'Confidence Building',
            'qualification_route' => 'Qualification Route',
            'ai_work_experience' => 'AI Work Experience Journey',
        );
    }
}

if (!function_exists('career_pathway_label')) {
    function career_pathway_label($slug)
    {
        $map = career_pathway_slugs();
        $k = (string) $slug;
        if (isset($map[$k])) {
            return $map[$k];
        }
        if ($k === 'apprenticeship') {
            return 'Apprenticeship Path (legacy)';
        }
        return ucwords(str_replace('_', ' ', $k));
    }
}

if (!function_exists('career_assessment_stage1_extended_ready')) {
    function career_assessment_stage1_extended_ready($conn)
    {
        return career_column_exists($conn, 'career_assessments', 'qualifications_text')
            && career_column_exists($conn, 'career_assessments', 'career_interests')
            && career_column_exists($conn, 'career_assessments', 'employment_goals');
    }
}

if (!function_exists('career_onboarding_schema_ready')) {
    function career_onboarding_schema_ready($conn)
    {
        return career_usermaster_career_columns_ready($conn)
            && career_table_exists($conn, 'career_assessments')
            && career_assessment_stage1_extended_ready($conn);
    }
}

if (!function_exists('career_bootstrap_user_profile')) {
    function career_bootstrap_user_profile($conn, $userId)
    {
        $uid = (int) $userId;
        if (!career_usermaster_career_columns_ready($conn)) {
            return;
        }
        mysqli_query($conn, "UPDATE cpo_usermaster SET career_assessment_completed = COALESCE(career_assessment_completed, 0) WHERE iUserId=" . $uid);
    }
}

if (!function_exists('career_get_user_summary')) {
    function career_get_user_summary($conn, $userId)
    {
        $uid = (int) $userId;
        $stage3Cols = career_column_exists($conn, 'cpo_usermaster', 'career_stage3_pcap_activated')
            ? ', COALESCE(career_stage3_pcap_activated,0) AS career_stage3_pcap_activated, career_stage3_activated_at'
            : '';
        if (career_usermaster_career_columns_ready($conn) && career_coaching_stage2_columns_ready($conn) && career_coaching_stage2_assessment_columns_ready($conn)) {
            $sql = "SELECT iUserId, vUserName, vUserEmailId, iUserType, COALESCE(career_assessment_completed,0) AS career_assessment_completed, career_mentor_id,
                    career_pathway, COALESCE(career_initial_coaching_completed,0) AS career_initial_coaching_completed, career_pathway_assigned_at,
                    career_stage2_qualifications_experience, career_stage2_skills_gaps, career_stage2_confidence_level,
                    career_stage2_employment_readiness, career_stage2_goal_clarity, career_stage2_barriers" . $stage3Cols . "
                    FROM cpo_usermaster WHERE iUserId=" . $uid . " LIMIT 1";
        } elseif (career_usermaster_career_columns_ready($conn) && career_coaching_stage2_columns_ready($conn)) {
            $sql = "SELECT iUserId, vUserName, vUserEmailId, iUserType, COALESCE(career_assessment_completed,0) AS career_assessment_completed, career_mentor_id,
                    career_pathway, COALESCE(career_initial_coaching_completed,0) AS career_initial_coaching_completed, career_pathway_assigned_at" . $stage3Cols . "
                    FROM cpo_usermaster WHERE iUserId=" . $uid . " LIMIT 1";
        } elseif (career_usermaster_career_columns_ready($conn)) {
            $sql = "SELECT iUserId, vUserName, vUserEmailId, iUserType, COALESCE(career_assessment_completed,0) AS career_assessment_completed, career_mentor_id
                    FROM cpo_usermaster WHERE iUserId=" . $uid . " LIMIT 1";
        } else {
            $sql = "SELECT iUserId, vUserName, vUserEmailId, iUserType
                    FROM cpo_usermaster WHERE iUserId=" . $uid . " LIMIT 1";
        }
        $res = mysqli_query($conn, $sql);
        if (!$res || mysqli_num_rows($res) === 0) {
            return null;
        }
        $row = mysqli_fetch_assoc($res);
        if (!career_usermaster_career_columns_ready($conn)) {
            $row['career_assessment_completed'] = 0;
            $row['career_mentor_id'] = null;
            $row['career_pathway'] = null;
            $row['career_initial_coaching_completed'] = 0;
            $row['career_pathway_assigned_at'] = null;
            $row['career_stage2_qualifications_experience'] = null;
            $row['career_stage2_skills_gaps'] = null;
            $row['career_stage2_confidence_level'] = null;
            $row['career_stage2_employment_readiness'] = null;
            $row['career_stage2_goal_clarity'] = null;
            $row['career_stage2_barriers'] = null;
            $row['career_stage3_pcap_activated'] = 0;
            $row['career_stage3_activated_at'] = null;
        } else {
            if (!career_coaching_stage2_columns_ready($conn)) {
                $row['career_pathway'] = null;
                $row['career_initial_coaching_completed'] = 0;
                $row['career_pathway_assigned_at'] = null;
                $row['career_stage2_qualifications_experience'] = null;
                $row['career_stage2_skills_gaps'] = null;
                $row['career_stage2_confidence_level'] = null;
                $row['career_stage2_employment_readiness'] = null;
                $row['career_stage2_goal_clarity'] = null;
                $row['career_stage2_barriers'] = null;
            }
            if (!isset($row['career_stage3_pcap_activated'])) {
                $row['career_stage3_pcap_activated'] = 0;
                $row['career_stage3_activated_at'] = null;
            }
            if ((int) ($row['career_assessment_completed'] ?? 0) === 0 && career_table_exists($conn, 'career_assessments')) {
                $chk = mysqli_query($conn, "SELECT 1 FROM career_assessments WHERE user_id=" . $uid . " LIMIT 1");
                if ($chk && mysqli_num_rows($chk) > 0) {
                    mysqli_query($conn, "UPDATE cpo_usermaster SET career_assessment_completed = 1 WHERE iUserId=" . $uid);
                    $row['career_assessment_completed'] = 1;
                }
            }
        }
        return $row;
    }
}

if (!function_exists('career_get_mentor_pool')) {
    function career_get_mentor_pool($conn)
    {
        if (!career_table_exists($conn, 'career_mentors')) {
            return array();
        }
        $sql = "SELECT m.iUserId, um.vUserName
                FROM career_mentors m
                INNER JOIN cpo_usermaster um ON um.iUserId = m.iUserId
                WHERE m.is_active = 1 AND um.iUserStatus = 1
                ORDER BY m.last_assigned_at ASC, m.iUserId ASC";
        $res = mysqli_query($conn, $sql);
        $rows = array();
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $rows[] = $row;
            }
        }
        return $rows;
    }
}

if (!function_exists('assign_mentor_round_robin')) {
    function assign_mentor_round_robin($conn, $userId)
    {
        $uid = (int) $userId;
        if (!career_usermaster_career_columns_ready($conn)) {
            return array(
                'status' => 'schema_missing',
                'mentor_id' => null,
                'message' => 'Career database columns are missing. Please run migrate_career_tables.php once, then try again.'
            );
        }
        $pool = career_get_mentor_pool($conn);

        if (count($pool) === 0) {
            // Assessment is complete; mentor will be assigned later (super admin or when pool is populated).
            mysqli_query($conn, "UPDATE cpo_usermaster SET career_mentor_id = NULL, career_assessment_completed = 1 WHERE iUserId=" . $uid);
            return array(
                'status' => 'pending',
                'mentor_id' => null,
                'message' => "Waiting for mentor assignment. You'll be notified within 48 hours."
            );
        }

        $mentor = $pool[0];
        $mentorId = (int) $mentor['iUserId'];
        $now = date('Y-m-d H:i:s');

        if (career_table_exists($conn, 'career_mentor_assignments')) {
            mysqli_query($conn, "INSERT INTO career_mentor_assignments (user_id, mentor_id, assigned_at, assignment_method)
                                 VALUES (" . $uid . ", " . $mentorId . ", '" . mysqli_real_escape_string($conn, $now) . "', 'round_robin')");
        }
        if (career_table_exists($conn, 'career_mentors')) {
            mysqli_query($conn, "UPDATE career_mentors SET last_assigned_at='" . mysqli_real_escape_string($conn, $now) . "' WHERE iUserId=" . $mentorId);
        }
        mysqli_query($conn, "UPDATE cpo_usermaster SET career_mentor_id = " . $mentorId . ", career_assessment_completed = 1 WHERE iUserId=" . $uid);

        return array(
            'status' => 'assigned',
            'mentor_id' => $mentorId,
            'message' => 'Mentor assigned successfully.'
        );
    }
}

if (!function_exists('career_get_plan_tokens')) {
    function career_get_plan_tokens($conn, $userId)
    {
        $uid = (int) $userId;
        $earned = 0;
        $total = 0;
        if (career_table_exists($conn, 'career_token_ledger')) {
            $earnedRes = mysqli_query($conn, "SELECT COALESCE(SUM(tokens),0) AS tokens FROM career_token_ledger WHERE user_id=" . $uid);
            $earned = ($earnedRes && mysqli_num_rows($earnedRes)) ? (int) mysqli_fetch_assoc($earnedRes)['tokens'] : 0;
        }
        if (career_table_exists($conn, 'career_plan_milestones')) {
            $totalRes = mysqli_query($conn, "SELECT COALESCE(SUM(token_value),0) AS tokens FROM career_plan_milestones WHERE user_id=" . $uid);
            $total = ($totalRes && mysqli_num_rows($totalRes)) ? (int) mysqli_fetch_assoc($totalRes)['tokens'] : 0;
        }
        $pct = $total > 0 ? round(($earned / $total) * 100, 1) : 0;
        return array('earned' => $earned, 'total' => $total, 'pct' => $pct);
    }
}

if (!function_exists('career_milestone_status_meta')) {
    function career_milestone_status_meta($status)
    {
        $s = (string) $status;
        if ($s === 'completed') {
            return array('label' => 'Completed', 'css' => 'roadmap-status--done', 'icon' => 'bi-check-circle-fill');
        }
        if ($s === 'in_progress') {
            return array('label' => 'In progress', 'css' => 'roadmap-status--active', 'icon' => 'bi-hourglass-split');
        }
        return array('label' => 'Not started', 'css' => 'roadmap-status--pending', 'icon' => 'bi-circle');
    }
}

if (!function_exists('career_sync_milestone_status_from_tasks')) {
    /**
     * Align milestone status with linked weekly tasks (roadmap reads milestones, not tasks).
     */
    function career_sync_milestone_status_from_tasks($conn, int $milestoneId, int $userId): void
    {
        if ($milestoneId <= 0 || $userId <= 0) {
            return;
        }
        if (!career_table_exists($conn, 'career_plan_milestones') || !career_table_exists($conn, 'career_weekly_tasks')) {
            return;
        }
        $mid = (int) $milestoneId;
        $uid = (int) $userId;
        $countRes = mysqli_query($conn, "SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN status='completed' THEN 1 ELSE 0 END) AS done
            FROM career_weekly_tasks WHERE milestone_id=" . $mid . " AND user_id=" . $uid);
        if (!$countRes || !mysqli_num_rows($countRes)) {
            return;
        }
        $row = mysqli_fetch_assoc($countRes);
        $total = (int) $row['total'];
        $done = (int) $row['done'];
        if ($total === 0) {
            return;
        }
        if ($done >= $total) {
            mysqli_query($conn, "UPDATE career_plan_milestones SET status='completed', completed_at=NOW()
                WHERE id=" . $mid . " AND user_id=" . $uid);
        } elseif ($done > 0) {
            mysqli_query($conn, "UPDATE career_plan_milestones SET status='in_progress', completed_at=NULL
                WHERE id=" . $mid . " AND user_id=" . $uid . " AND status!='completed'");
        } else {
            mysqli_query($conn, "UPDATE career_plan_milestones SET status='not_started', completed_at=NULL
                WHERE id=" . $mid . " AND user_id=" . $uid);
        }
    }
}

if (!function_exists('career_sync_all_milestone_statuses')) {
    function career_sync_all_milestone_statuses($conn, int $userId): void
    {
        if ($userId <= 0 || !career_table_exists($conn, 'career_plan_milestones')) {
            return;
        }
        $uid = (int) $userId;
        $res = mysqli_query($conn, "SELECT DISTINCT milestone_id FROM career_weekly_tasks WHERE user_id=" . $uid . " AND milestone_id>0");
        if (!$res) {
            return;
        }
        while ($row = mysqli_fetch_assoc($res)) {
            career_sync_milestone_status_from_tasks($conn, (int) $row['milestone_id'], $uid);
        }
    }
}
