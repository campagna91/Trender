<?
	require_once '__system.php';
	$class = $_POST['class'];
	$package = $_POST['package'];
	$kMethods = "select signature, returnType from ClassMethods where class = '$class' and package = '$package'";
	$q = mysqli_query(connect(), $kMethods) or die("ERRORE: " . $kMethods);
	while($v = $q->fetch_array()) { ?>
		<option value="<? echo $v[1] . "." . $v[0] ?>"><? echo $v[1] . "." . $v[0] ?></option>f
	<? }
?>