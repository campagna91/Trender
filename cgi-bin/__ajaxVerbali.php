<?
	require_once('funzioniSistema.php');

	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = ""; 
	switch($typeRequest)
	{
		case('new'):
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
		case('relationAddRequirement'):
			$k = "insert into RequisitiVerbali values('$data[1]','$data[0]')";			break;
		case('relationDeleteRequirement'):
			$k = "delete from RequisitiVerbali where idR = '$data[1]' and idV = '$data[0]'";			break;
		case('relationAddUsecase'):
			$k = "insert into CasiUsoVerbali values ('$data[1]','$data[0]') ";			break;
		case('relationDeleteUsecase'):
			$k = "delete from CasiUsoVerbali where idV = '$data[0]' and idUC = '$data[1]'";			break;
	}
	if($k != "") $q = mysqli_query(connect(),$k) or die("Err ".$typeRequest."\n$k");
?>