<?
	$query = $_POST['query'];
	$id = $_POST['id'];
	require_once("__system.php");

	switch($query){
		case('class relactions') : $k = "select count('classB') as num from ClassRelactions where classA = '$id' "; break;
	}
	$q = mysqli_query(connect(), $k) or die("ERR - ".$k);
	$v = $q->fetch_assoc();
	echo $v['num'];
	//echo mysqli_num_rows($q);