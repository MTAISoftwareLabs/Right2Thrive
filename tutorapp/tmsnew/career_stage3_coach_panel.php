<?php
/**
 * Coach / admin Stage 3 PCAP panel.
 * Expects: $conn, $staffId, $mode, $learnerId, $summary, optional $pcapFlash
 */
require_once dirname(__DIR__, 2) . '/career_stage3_lib.php';

career_stage3_ensure_schema($conn);
$learnerId = (int) ($learnerId ?? 0);
if ($learnerId <= 0) {
    return;
}
if (!isset($summary) || !is_array($summary)) {
    $summary = career_get_user_summary($conn, $learnerId);
}
$stage2Done = career_stage2_complete($summary);
$stage3Active = career_stage3_active($summary);
$plan = $stage3Active ? career_get_pcap_plan($conn, $learnerId) : null;
$workshops = $stage3Active ? career_pcap_list_workshops($conn, $learnerId) : array();
$targets = $stage3Active ? career_pcap_list_weekly_targets($conn, $learnerId) : array();
$sessions = $stage3Active ? career_pcap_list_sessions($conn, $learnerId) : array();
$notes = $stage3Active ? career_pcap_list_coaching_notes($conn, $learnerId) : array();
$progressPct = $plan ? career_pcap_progress_pct($conn, $learnerId, $plan) : 0;
$pcapFlash = isset($pcapFlash) ? (string) $pcapFlash : '';
?>
<div class="card cpm-card mb-3" id="stage3-coach-pcap">
    <div class="card-header flex-shrink-0">
        <h5 class="mb-0"><i class="bi bi-clipboard2-check me-2 text-primary"></i>Stage 3 · Personal Career Action Plan (PCAP)</h5>
        <div class="small text-muted">Week 1–2 · CV, LinkedIn, workshops, weekly targets, training &amp; confidence goals</div>
    </div>
    <div class="card-body">
        <?php if ($pcapFlash !== '') { ?>
            <div class="alert alert-info py-2 mb-3 rounded-3 border-0"><?php echo htmlspecialchars($pcapFlash, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php } ?>
        <?php if (!$stage2Done) { ?>
            <div class="alert alert-warning mb-0 rounded-3 border-0">
                <i class="bi bi-lock me-1"></i>
                <?php echo htmlspecialchars(career_stage3_block_message($summary), ENT_QUOTES, 'UTF-8'); ?>
            </div>
        <?php } elseif (!$stage3Active) { ?>
            <p class="small text-muted mb-3">Stage 2 is complete. Build the PCAP below and activate it for the learner dashboard.</p>
            <form method="post" class="mb-0">
                <input type="hidden" name="user_id" value="<?php echo $learnerId; ?>">
                <input type="hidden" name="pcap_action" value="activate_pcap">
                <?php include __DIR__ . '/career_stage3_pcap_form_fields.php'; ?>
                <button type="submit" class="btn btn-success cpm-btn-success mt-3">
                    <i class="bi bi-lightning-charge me-1"></i> Activate Stage 3 · Action Plan
                </button>
            </form>
        <?php } else { ?>
            <div class="row g-3 mb-4">
                <div class="col-sm-4">
                    <div class="border rounded-3 p-3 h-100">
                        <div class="small text-muted text-uppercase fw-semibold">Progress</div>
                        <div class="fs-4 fw-bold"><?php echo (int) $progressPct; ?>%</div>
                        <div class="progress mt-2" style="height:6px;">
                            <div class="progress-bar" style="width:<?php echo (int) $progressPct; ?>%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="border rounded-3 p-3 h-100">
                        <div class="small text-muted text-uppercase fw-semibold">Engagement</div>
                        <div class="fw-bold text-capitalize"><?php echo htmlspecialchars((string) ($plan['engagement_level'] ?? 'medium'), ENT_QUOTES, 'UTF-8'); ?></div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="border rounded-3 p-3 h-100">
                        <div class="small text-muted text-uppercase fw-semibold">Activated</div>
                        <div class="small"><?php echo htmlspecialchars((string) ($summary['career_stage3_activated_at'] ?? '—'), ENT_QUOTES, 'UTF-8'); ?></div>
                        <span class="badge bg-success mt-1">Stage 3: Action Plan Activated</span>
                    </div>
                </div>
            </div>

            <form method="post" class="mb-4">
                <input type="hidden" name="user_id" value="<?php echo $learnerId; ?>">
                <input type="hidden" name="pcap_action" value="update_pcap">
                <?php
                $showCompletionPct = true;
                include __DIR__ . '/career_stage3_pcap_form_fields.php';
                ?>
                <button type="submit" class="btn btn-primary cpm-btn-primary mt-3"><i class="bi bi-save me-1"></i> Update PCAP plan</button>
            </form>

            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="fw-semibold">Assigned workshops</h6>
                    <?php if ($workshops === array()) { ?>
                        <p class="small text-muted">None yet.</p>
                    <?php } else { ?>
                        <ul class="list-group list-group-flush small mb-2">
                        <?php foreach ($workshops as $w) { ?>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span><?php echo htmlspecialchars((string) $w['title'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <span class="text-muted"><?php echo htmlspecialchars((string) $w['status'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
                    <form method="post" class="row g-2 align-items-end">
                        <input type="hidden" name="user_id" value="<?php echo $learnerId; ?>">
                        <input type="hidden" name="pcap_action" value="add_workshop">
                        <div class="col-7"><input class="form-control" name="workshop_title" placeholder="Workshop title" required></div>
                        <div class="col-3"><input class="form-control" name="workshop_week" placeholder="Week"></div>
                        <div class="col-2"><button type="submit" class="btn btn-outline-primary btn-sm w-100">Add</button></div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h6 class="fw-semibold">Weekly application targets</h6>
                    <?php if ($targets === array()) { ?>
                        <p class="small text-muted">None yet.</p>
                    <?php } else { ?>
                        <ul class="list-group list-group-flush small mb-2">
                        <?php foreach ($targets as $t) { ?>
                            <li class="list-group-item px-0">
                                <?php echo htmlspecialchars((string) $t['week_start'], ENT_QUOTES, 'UTF-8'); ?>:
                                <?php echo (int) $t['applications_target']; ?> apps
                                <span class="text-muted">(<?php echo htmlspecialchars((string) $t['status'], ENT_QUOTES, 'UTF-8'); ?>)</span>
                            </li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
                    <form method="post" class="row g-2 align-items-end">
                        <input type="hidden" name="user_id" value="<?php echo $learnerId; ?>">
                        <input type="hidden" name="pcap_action" value="add_weekly_target">
                        <div class="col-5"><input class="form-control" type="date" name="target_week_start" required></div>
                        <div class="col-4"><input class="form-control" type="number" name="applications_target" min="0" value="5" placeholder="Target"></div>
                        <div class="col-3"><button type="submit" class="btn btn-outline-primary btn-sm w-100">Add</button></div>
                    </form>
                </div>

                <div class="col-md-6 mt-3">
                    <h6 class="fw-semibold">Upcoming sessions</h6>
                    <?php if ($sessions === array()) { ?>
                        <p class="small text-muted">None scheduled.</p>
                    <?php } else { ?>
                        <ul class="list-group list-group-flush small mb-2">
                        <?php foreach ($sessions as $s) { ?>
                            <li class="list-group-item px-0">
                                <strong><?php echo htmlspecialchars((string) $s['title'], ENT_QUOTES, 'UTF-8'); ?></strong>
                                <span class="text-muted"> · <?php echo htmlspecialchars((string) $s['session_at'], ENT_QUOTES, 'UTF-8'); ?></span>
                            </li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
                    <form method="post" class="row g-2 align-items-end">
                        <input type="hidden" name="user_id" value="<?php echo $learnerId; ?>">
                        <input type="hidden" name="pcap_action" value="add_session">
                        <div class="col-5"><input class="form-control" type="datetime-local" name="session_at" required></div>
                        <div class="col-5"><input class="form-control" name="session_title" placeholder="Session title" required></div>
                        <div class="col-2"><button type="submit" class="btn btn-outline-primary btn-sm w-100">Add</button></div>
                    </form>
                </div>
                <div class="col-md-6 mt-3">
                    <h6 class="fw-semibold">Coaching notes</h6>
                    <?php if ($notes === array()) { ?>
                        <p class="small text-muted">No notes yet.</p>
                    <?php } else { ?>
                        <ul class="list-group list-group-flush small mb-2">
                        <?php foreach ($notes as $n) { ?>
                            <li class="list-group-item px-0">
                                <div class="text-muted small"><?php echo htmlspecialchars((string) ($n['created_at'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                                <?php if (!empty($n['mentor_name'])) { echo ' · ' . htmlspecialchars((string) $n['mentor_name'], ENT_QUOTES, 'UTF-8'); } ?></div>
                                <?php echo nl2br(htmlspecialchars((string) ($n['note_text'] ?? ''), ENT_QUOTES, 'UTF-8')); ?>
                            </li>
                        <?php } ?>
                        </ul>
                    <?php } ?>
                    <form method="post">
                        <input type="hidden" name="user_id" value="<?php echo $learnerId; ?>">
                        <input type="hidden" name="pcap_action" value="add_coaching_note">
                        <textarea class="form-control mb-2" name="coaching_note" rows="2" placeholder="Coaching note (staff)" required></textarea>
                        <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="bi bi-journal-plus me-1"></i> Save note</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
