<?php
/** Shared PCAP form fields — expects $plan (array|null), optional $showCompletionPct */
$plan = isset($plan) && is_array($plan) ? $plan : array();
$cvStatus = (string) ($plan['cv_status'] ?? 'not_started');
$liApp = !isset($plan['linkedin_applicable']) || !empty($plan['linkedin_applicable']);
$liStatus = (string) ($plan['linkedin_status'] ?? 'not_started');
$eng = (string) ($plan['engagement_level'] ?? 'medium');
$showCompletionPct = !empty($showCompletionPct);
?>
<div class="row g-2">
    <div class="col-md-6">
        <label class="form-label">CV status</label>
        <select class="form-control" name="cv_status">
            <option value="not_started"<?php echo $cvStatus === 'not_started' ? ' selected' : ''; ?>>Not started</option>
            <option value="in_progress"<?php echo $cvStatus === 'in_progress' ? ' selected' : ''; ?>>In progress</option>
            <option value="completed"<?php echo $cvStatus === 'completed' ? ' selected' : ''; ?>>Completed</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Engagement level</label>
        <select class="form-control" name="engagement_level">
            <option value="low"<?php echo $eng === 'low' ? ' selected' : ''; ?>>Low</option>
            <option value="medium"<?php echo $eng === 'medium' ? ' selected' : ''; ?>>Medium</option>
            <option value="high"<?php echo $eng === 'high' ? ' selected' : ''; ?>>High</option>
        </select>
    </div>
</div>
<label class="form-label mt-2">CV notes</label>
<textarea class="form-control mb-2" name="cv_notes" rows="2"><?php echo htmlspecialchars((string) ($plan['cv_notes'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></textarea>
<div class="form-check mb-2">
    <input class="form-check-input" type="checkbox" name="linkedin_applicable" value="1" id="pcap_li_app"<?php echo $liApp ? ' checked' : ''; ?>>
    <label class="form-check-label" for="pcap_li_app">LinkedIn applicable</label>
</div>
<div class="row g-2">
    <div class="col-md-6">
        <label class="form-label">LinkedIn status</label>
        <select class="form-control" name="linkedin_status">
            <option value="not_started"<?php echo $liStatus === 'not_started' ? ' selected' : ''; ?>>Not started</option>
            <option value="in_progress"<?php echo $liStatus === 'in_progress' ? ' selected' : ''; ?>>In progress</option>
            <option value="completed"<?php echo $liStatus === 'completed' ? ' selected' : ''; ?>>Completed</option>
            <option value="not_applicable"<?php echo $liStatus === 'not_applicable' ? ' selected' : ''; ?>>Not applicable</option>
        </select>
    </div>
    <?php if ($showCompletionPct) { ?>
    <div class="col-md-6">
        <label class="form-label">Coach completion % (override)</label>
        <input class="form-control" type="number" name="coach_completion_pct" min="0" max="100" value="<?php echo (int) ($plan['coach_completion_pct'] ?? 0); ?>">
    </div>
    <?php } ?>
</div>
<label class="form-label mt-2">LinkedIn notes</label>
<textarea class="form-control mb-2" name="linkedin_notes" rows="2"><?php echo htmlspecialchars((string) ($plan['linkedin_notes'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></textarea>
<label class="form-label">Required training</label>
<textarea class="form-control mb-2" name="required_training" rows="2"><?php echo htmlspecialchars((string) ($plan['required_training'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></textarea>
<label class="form-label">Confidence-building goals</label>
<textarea class="form-control mb-2" name="confidence_goals" rows="2"><?php echo htmlspecialchars((string) ($plan['confidence_goals'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></textarea>
