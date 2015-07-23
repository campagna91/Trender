<?
	require_once('__system.php');
	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = ""; 
	switch($typeRequest)
	{
		case('insert'):
			if(!esiste($data[0]))
			{
				$data[1] = mysqli_real_escape_string(connect(),$data[1]);
				$k = "insert into Verbali values('$data[0]','$data[1]') ";
			}
			break;
		case('update'):
			if(!esiste($data[1]))
			{
				$data[1] = mysqli_real_escape_string(connect(),$data[1]);
				$k = "UPDATE Verbali set stesura = '$data[1]' where data = CAST('$data[0]' AS DATE) ";
			}
			break;
		case('delete'):
			$k = "delete from Verbali where data = '$data[0]'";			break;
		case('requirementInsert'):
			$k = "insert into RequisitiVerbali values('$data[1]','$data[0]')";			break;
		case('requirementDelete'):
			$k = "delete from RequisitiVerbali where idR = '$data[1]' and idV = '$data[0]'";			break;
		case('usecaseInsert'):
			$k = "insert into CasiUsoVerbali values ('$data[1]','$data[0]') ";			break;
		case('usecaseDelete'):
			$k = "delete from CasiUsoVerbali where idV = '$data[0]' and idUC = '$data[1]'";			break;
	}
	if($k != "") 
		if(!mysqli_query(connect(),$k)) echo "ERR - in(".$typeRequest.")\n".$k;
		else echo $k;
?>