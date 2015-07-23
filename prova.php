<?
	require_once('cgi-bin/__system.php');
	$k = "select * from Test where object = 'r0f16'";
	$q = mysqli_query(connect(),$k)or die ($k);
	$v = $q->fetch_array();
	echo $v[0]."\n".$v[1]."\n".$v[2]."\n";