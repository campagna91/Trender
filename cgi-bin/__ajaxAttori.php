<?
	require_once('funzioniSistema.php');

	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = "";
	switch($typeRequest){
		case('new'):
			if(!esiste($data[0]) && $data[0]!="")
			{
				$k = "insert into Attori (idA) values ('$data[0]')";
				$q = mysqli_query(connect(),$k) or die("ATTORI : (new) ".$k);
			} 
				break;	
		case('delete'):
			$k = " delete from AttoriCasiUso where idA = '$data[0]'"; 
			$q = mysqli_query(connect(),$k) or die("ACTOR: (delete) ".$k);
			$k = " delete from Attori where idA = '$data[0]'"; 			break;
		case('update'):
			if(!esiste($data[1])){
				$data[1] = mysqli_real_escape_string(connect(),$data[1]);
				$data[0] = mysqli_real_escape_string(connect(),$data[0]);
				$k = "update Attori set idA='$data[1]' where idA = '$data[0]'";
			}
			break;
		case('relationAddUsecase'):
			$k = "insert into AttoriCasiUso(idA,idUC) values('$data[0]','$data[1]')";			break;
		case('relationDeleteUsecase'):
			$k = "delete from AttoriCasiUso where idUC = '$data[1]' and  idA = '$data[0]'";			break;
	}
	if($k != "") $q = mysqli_query(connect(),$k) or die("Err ".$typeRequest."\n$k");
?>