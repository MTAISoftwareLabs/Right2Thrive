<?php
/**
 * Collective Careers Hub — 9-Week Employability & AI Work Experience Journey.
 * Included from career-progress-dashboard.php inside <div class="cd-workshops">…</div>
 */
$cdJourneyWeeks = array(
    array(
        'title' => 'Career Foundation',
        'tasks' => array(
            'Attend Career Planning Introduction',
            'Set career goals',
            'Create personal action plan',
        ),
        'reward' => '1 Token + Welcome Gift',
    ),
    array(
        'title' => 'CV Development',
        'tasks' => array(
            'Attend CV Writing Workshop',
            'Complete professional CV',
            'Receive feedback and improvements',
        ),
        'reward' => '2 Tokens',
    ),
    array(
        'title' => 'Personal Branding',
        'tasks' => array(
            'Attend Personal Statement Workshop',
            'Complete personal statement',
            'Strengthen professional profile',
        ),
        'reward' => '2 Tokens',
    ),
    array(
        'title' => 'Interview & Application Skills',
        'tasks' => array(
            'Attend Interview Workshop',
            'Attend Job Application Workshop',
            'Practice mock interviews',
        ),
        'reward' => '3 Tokens',
    ),
    array(
        'title' => 'Job Applications & Work Placement',
        'tasks' => array(
            'Submit 4 job applications (Mon–Thurs)',
            'Attend work placement',
            'Develop teamwork and communication skills',
        ),
        'reward' => '4 Tokens + Completion Certificate',
    ),
    array(
        'title' => 'AI Foundations',
        'tasks' => array(
            'Introduction to Artificial Intelligence',
            'AI in the workplace',
            'Generate social media content using AI',
            'Responsible AI usage',
        ),
        'reward' => '2 Tokens',
    ),
    array(
        'title' => 'AI Business Idea Development',
        'tasks' => array(
            'Create AI-assisted business idea',
            'Define target market',
            'Develop services and pricing',
            'Build value proposition',
        ),
        'reward' => '2 Tokens',
    ),
    array(
        'title' => 'AI Content Creation & Marketing',
        'tasks' => array(
            'Create marketing posts using AI',
            'Develop brand voice',
            'Generate blog and ad copy',
            'Build mini digital portfolio',
        ),
        'reward' => '3 Tokens',
    ),
    array(
        'title' => 'Final AI Project & Presentation',
        'tasks' => array(
            'Complete AI-assisted business presentation',
            'Present to review panel',
            'Demonstrate AI workplace skills',
            'Reflect and receive feedback',
        ),
        'reward' => '4 Tokens + AI Work Experience Certificate',
    ),
);
?>
<style>
    .cd-workshops { --cd-accent: #4f46e5; --cd-accent-soft: #eef2ff; --cd-ink: #0f172a; --cd-muted: #64748b; }
    .cd-workshops .cd-hero {
        background: linear-gradient(135deg, #eef2ff 0%, #f0fdfa 45%, #f8fafc 100%);
        border: 1px solid #c7d2fe;
        border-radius: 1rem;
        padding: 1.25rem 1.35rem;
        margin-bottom: 1.5rem;
    }
    .cd-workshops .cd-hero h2 { font-weight: 800; letter-spacing: -0.02em; color: var(--cd-ink); font-size: 1.35rem; margin: 0 0 0.5rem; }
    .cd-workshops .cd-meta { font-size: 0.9rem; color: var(--cd-muted); margin-bottom: 0.35rem; }
    .cd-workshops .cd-meta i { color: var(--cd-accent); margin-right: 0.35rem; }
    .cd-workshops .cd-workshop-card {
        border: 1px solid #e2e8f0;
        border-radius: 0.85rem;
        height: 100%;
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }
    .cd-workshops .cd-workshop-card:hover { box-shadow: 0 12px 28px rgba(79, 70, 229, 0.1); transform: translateY(-2px); }
    .cd-workshops .cd-workshop-card .card-header {
        background: linear-gradient(180deg, #fafbff 0%, #fff 100%);
        border-bottom: 1px solid #eef2f7;
        font-weight: 700;
    }
    .cd-workshops .cd-badge-num {
        display: inline-flex; align-items: center; justify-content: center;
        width: 1.75rem; height: 1.75rem; border-radius: 999px;
        background: var(--cd-accent); color: #fff; font-size: 0.85rem; font-weight: 800; margin-right: 0.5rem;
    }
    .cd-workshops .cd-list { margin: 0; padding-left: 1.1rem; font-size: 0.88rem; color: #334155; }
    .cd-workshops .cd-list li { margin-bottom: 0.35rem; }
    .cd-workshops .cd-reward {
        font-size: 0.82rem;
        margin-top: 0.75rem;
        padding-top: 0.75rem;
        border-top: 1px dashed #e2e8f0;
        color: var(--cd-ink);
    }
    .cd-workshops .cd-reward strong { color: #059669; }
    .cd-workshops .cd-series-gains {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 0.85rem;
        padding: 1rem 1.15rem;
    }
</style>
<section class="mb-0" aria-labelledby="workshops-heading">
    <div class="cd-hero">
        <h2 id="workshops-heading">Collective Careers Hub</h2>
        <p class="fw-semibold mb-2">9-Week Employability &amp; AI Work Experience Journey</p>
        <p class="cd-meta mb-0"><i class="bi bi-hourglass-split"></i><strong>Total programme duration:</strong> 9 weeks</p>
        <p class="cd-meta mb-0 mt-1"><i class="bi bi-arrow-up-right-circle"></i>Participants move from unemployment to employment readiness with AI-powered workplace skills.</p>
    </div>

    <div class="row g-3">
        <?php foreach ($cdJourneyWeeks as $i => $week) { ?>
        <div class="col-md-6 col-xl-4">
            <div class="card cd-workshop-card h-100">
                <div class="card-header">
                    <span class="cd-badge-num"><?php echo (int) ($i + 1); ?></span>
                    Week <?php echo (int) ($i + 1); ?> &mdash; <?php echo htmlspecialchars($week['title']); ?>
                </div>
                <div class="card-body">
                    <ul class="cd-list">
                        <?php foreach ($week['tasks'] as $task) { ?>
                        <li><?php echo htmlspecialchars($task); ?></li>
                        <?php } ?>
                    </ul>
                    <p class="cd-reward mb-0"><strong>Reward:</strong> <?php echo htmlspecialchars($week['reward']); ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="cd-series-gains mt-4">
        <h3 class="h5 fw-bold mb-2"><i class="bi bi-trophy text-warning me-2"></i>Programme outcome</h3>
        <p class="mb-0 text-muted small">Complete each week with your career coach to earn tokens, certificates, and AI workplace skills — building a clear path from career foundation to employment readiness.</p>
    </div>
</section>
