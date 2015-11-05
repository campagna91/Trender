<?
	require_once '__system.php';
	$package = $_POST['package'];
	$kClass = "select class from Classes where package = '$package'";
	$q = mysqli_query(connect(), $kClass) or die("ERRORE: " . $kClass);
	while($v = $q->fetch_array()) { ?>
		<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option>
	<? }
