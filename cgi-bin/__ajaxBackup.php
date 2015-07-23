<?php
	require_once('__system.php');
	$output = shell_exec("sudo /home/simi/automysqlbackup-v3.0_rc6/automysqlbackup");
	echo($output);
?>