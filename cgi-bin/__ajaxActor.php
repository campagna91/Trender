<?
	require_once('__system.php');
	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = "";
	switch($typeRequest){
		case('insert'):
			$data[0] = mysqli_real_escape_string(connect(),$data[0]);
			if(!esiste($data[0]))
			{
				$k = "insert into Attori (idA) values ('$data[0]')";
			} 
			else echo "esiste gà";
				break;	
		case('delete'):
			$data[0] = mysqli_real_escape_string(connect(),$data[0]);
			$k = " delete from Attori where idA = '$data[0]'"; 			break;
		case('update'):
			$data[0] = mysqli_real_escape_string(connect(),$data[0]);
			if(!esiste($data[0])){
				$data[1] = mysqli_real_escape_string(connect(),$data[1]);
				$k = "update Attori set idA='$data[0]' where idA = '$data[1]'";
			}
			break;
		case('usecaseInsert'):
			$data[0] = mysqli_real_escape_string(connect(),$data[0]);
			$k = "insert into AttoriCasiUso(idA,idUC) values('$data[0]','$data[1]')";			break;
		case('usecaseDelete'):
			$data[0] = mysqli_real_escape_string(connect(),$data[0]);
			$k = "delete from AttoriCasiUso where idUC = '$data[1]' and  idA = '$data[0]'";			break;
	}
	if($k != "") 
		if(!mysqli_query(connect(),$k)) echo "ERR - in(".$typeRequest.")\n".$k;
		else echo $k;
?>