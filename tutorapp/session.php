<?php
	ini_set('session.gc_maxlifetime', 20000);
	ini_set('session.cache_expire',2000);
	@ini_set('session.use_trans_sid',1);	
	session_set_cookie_params(800);
	session_start();

$u=$_SESSION['u'];
	
?>
