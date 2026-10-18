<?php
/** Participant Stage 3 PCAP panel — expects $conn, $userId, $summary */
require_once dirname(__DIR__) . '/career_stage3_lib.php';

career_stage3_ensure_schema($conn);
$canAccess = career_can_access_stage3($summary);
$blockMsg = career_stage3_block_message($summary);
$stage3Active = career_stage3_active($summary);
$plan = $stage3Active ? career_get_pcap_plan($conn, $userId) : null;
$workshops = $stage3Active ? career_pcap_list_workshops($conn, $userId) : array();
$targets = $stage3Active ? career_pcap_list_weekly_targets($conn, $userId) : array();
$sessions = $stage3Active ? career_pcap_list_sessions($conn, $userId) : array();
$progressPct = $plan ? career_pcap_progress_pct($conn, $userId, $plan) : 0;
$pathwayLabel = !empty($summary['career_pathway']) ? career_pathway_label((string) $summary['career_pathway']) : '';
?>
<div class="glass-card mb-4" id="stage3-pcap">
    <div class="card-header-neo d-flex flex-wrap justify-content-between align-items-center gap-2">
        <span><i class="bi bi-clipboard2-check"></i> Stage 3 · Personal Career Action Plan (PCAP)</span>
        <span class="badge-soft">Week 1–2</span>
    </div>
    <div class="p-4">
        <?php if (!$canAccess): ?>
            <div class="alert alert-secondary border-0 rounded-4 mb-0">
                <i class="bi bi-lock-fill me-2"></i>
                <?php echo htmlspecialchars($blockMsg, ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-success border-0 rounded-4 py-2 mb-4">
                <strong>Stage 3: Action Plan Activated</strong> — your coach has published your PCAP.
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="metric-tile p-3 h-100">
                        <div class="text-secondary small fw-semibold text-uppercase">Assigned pathway</div>
                        <div class="fw-bold mt-1"><?php echo $pathwayLabel !== '' ? htmlspecialchars($pathwayLabel, ENT_QUOTES, 'UTF-8') : '—'; ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric-tile p-3 h-100">
                        <div class="text-secondary small fw-semibold text-uppercase">Progress</div>
                        <div class="metric-number" style="font-size:1.75rem;"><?php echo (int) $progressPct; ?>%</div>
                        <div class="progress mt-2" style="height:8px;border-radius:99px;">
                            <div class="progress-bar" style="width:<?php echo (int) $progressPct; ?>%;background:#3b3ce4;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="metric-tile p-3 h-100">
                        <div class="text-secondary small fw-semibold text-uppercase">Engagement</div>
                        <div class="fw-bold mt-1 text-capitalize"><?php echo htmlspecialchars((string) ($plan['engagement_level'] ?? 'medium'), ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <h6 class="fw-bold mb-2"><i class="bi bi-file-earmark-person"></i> CV development</h6>
                    <p class="small mb-0"><span class="badge bg-light text-dark"><?php echo htmlspecialchars((string) ($plan['cv_status'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php if (!empty($plan['cv_notes'])) { echo '<br>' . nl2br(htmlspecialchars((string) $plan['cv_notes'], ENT_QUOTES, 'UTF-8')); } ?></p>
                    <?php if (!empty($plan['linkedin_applicable'])): ?>
                    <h6 class="fw-bold mb-2 mt-3"><i class="bi bi-linkedin"></i> LinkedIn profile</h6>
                    <p class="small mb-0"><span class="badge bg-light text-dark"><?php echo htmlspecialchars((string) ($plan['linkedin_status'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php if (!empty($plan['linkedin_notes'])) { echo '<br>' . nl2br(htmlspecialchars((string) $plan['linkedin_notes'], ENT_QUOTES, 'UTF-8')); } ?></p>
                    <?php endif; ?>
                    <h6 class="fw-bold mb-2 mt-3"><i class="bi bi-mortarboard"></i> Required training</h6>
                    <p class="small"><?php echo nl2br(htmlspecialchars((string) ($plan['required_training'] ?? '—'), ENT_QUOTES, 'UTF-8')); ?></p>
                    <h6 class="fw-bold mb-2"><i class="bi bi-heart"></i> Confidence-building goals</h6>
                    <p class="small mb-0"><?php echo nl2br(htmlspecialchars((string) ($plan['confidence_goals'] ?? '—'), ENT_QUOTES, 'UTF-8')); ?></p>
                </div>
                <div class="col-lg-6">
                    <h6 class="fw-bold mb-2"><i class="bi bi-calendar-week"></i> Assigned workshops</h6>
                    <?php if ($workshops === array()): ?>
                        <p class="small text-muted">No workshops assigned yet.</p>
                    <?php else: ?>
                        <ul class="list-unstyled small">
                        <?php foreach ($workshops as $w): ?>
                            <li class="task-neo mb-2 d-flex justify-content-between">
                                <span><?php echo htmlspecialchars((string) $w['title'], ENT_QUOTES, 'UTF-8'); ?>
                                <?php if (!empty($w['week_label'])) { echo ' <span class="text-muted">(' . htmlspecialchars((string) $w['week_label'], ENT_QUOTES, 'UTF-8') . ')</span>'; } ?></span>
                                <span class="badge bg-light text-dark"><?php echo htmlspecialchars((string) $w['status'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <h6 class="fw-bold mb-2 mt-3"><i class="bi bi-bullseye"></i> Weekly application targets</h6>
                    <?php if ($targets === array()): ?>
                        <p class="small text-muted">No weekly targets yet.</p>
                    <?php else: ?>
                        <ul class="list-unstyled small">
                        <?php foreach ($targets as $t): ?>
                            <li class="task-neo mb-2">
                                Week of <?php echo htmlspecialchars((string) $t['week_start'], ENT_QUOTES, 'UTF-8'); ?>:
                                target <strong><?php echo (int) $t['applications_target']; ?></strong> applications
                                <span class="text-muted">(<?php echo htmlspecialchars((string) $t['status'], ENT_QUOTES, 'UTF-8'); ?>)</span>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <h6 class="fw-bold mb-2 mt-3"><i class="bi bi-calendar-event"></i> Upcoming sessions</h6>
                    <?php if ($sessions === array()): ?>
                        <p class="small text-muted">No sessions scheduled yet.</p>
                    <?php else: ?>
                        <ul class="list-unstyled small">
                        <?php foreach ($sessions as $s): ?>
                            <li class="task-neo mb-2">
                                <strong><?php echo htmlspecialchars((string) $s['title'], ENT_QUOTES, 'UTF-8'); ?></strong><br>
                                <span class="text-muted"><?php echo htmlspecialchars((string) $s['session_at'], ENT_QUOTES, 'UTF-8'); ?></span>
                                · <?php echo htmlspecialchars((string) $s['status'], ENT_QUOTES, 'UTF-8'); ?>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
