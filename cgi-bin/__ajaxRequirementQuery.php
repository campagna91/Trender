<?
	$query = $_POST['query'];
	$idR = $_POST['id'];
	require_once("__system.php");

	switch($query){
		case('package required') : $k = "select count('titolo') as num from PackageRequirement where idR = '$idR' "; break;
	}
	$q = mysqli_query(connect(), $k) or die("ERR - ".$k);
	$v = $q->fetch_assoc();
	echo $v['num'];
	//echo mysqli_num_rows($q);