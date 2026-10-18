<?php
if (!isset($hub_interactive_tab)) {
	$hub_interactive_tab = 'download';
}
?>
						<ul class="nav nav-tabs hub-interactive-tabs" id="hubInteractiveTablist" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link<?php echo $hub_interactive_tab === 'download' ? ' active' : ''; ?>" id="download-center-tab" href="in-download-center.php" role="tab" aria-controls="download-center" aria-selected="<?php echo $hub_interactive_tab === 'download' ? 'true' : 'false'; ?>"<?php echo $hub_interactive_tab === 'download' ? ' aria-current="page"' : ''; ?>><i class="bi bi-cloud-download hub-interactive-tabs__icon" aria-hidden="true"></i> Download Center</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link<?php echo $hub_interactive_tab === 'book' ? ' active' : ''; ?>" id="book-chat-tab" href="in-book-chat.php" role="tab" aria-controls="book-chat" aria-selected="<?php echo $hub_interactive_tab === 'book' ? 'true' : 'false'; ?>"<?php echo $hub_interactive_tab === 'book' ? ' aria-current="page"' : ''; ?>><i class="bi bi-chat-dots hub-interactive-tabs__icon" aria-hidden="true"></i> Book Chat</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link<?php echo $hub_interactive_tab === 'mail' ? ' active' : ''; ?>" id="mail-tutors-tab" href="in-mail-tutors.php" role="tab" aria-controls="mail-tutors" aria-selected="<?php echo $hub_interactive_tab === 'mail' ? 'true' : 'false'; ?>"<?php echo $hub_interactive_tab === 'mail' ? ' aria-current="page"' : ''; ?>><i class="bi bi-envelope hub-interactive-tabs__icon" aria-hidden="true"></i> Mail to tutor</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link<?php echo $hub_interactive_tab === 'event' ? ' active' : ''; ?>" id="event-history-tab" href="in-event-history.php" role="tab" aria-controls="event-history" aria-selected="<?php echo $hub_interactive_tab === 'event' ? 'true' : 'false'; ?>"<?php echo $hub_interactive_tab === 'event' ? ' aria-current="page"' : ''; ?>><i class="bi bi-clock-history hub-interactive-tabs__icon" aria-hidden="true"></i> Event history</a>
							</li>
						</ul>
