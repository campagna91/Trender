<? 
require_once("__system.php");
/***********************
 *
 *	SWITCH BETWEEN TYPE OF REQUEST ABOUT REQUISITE 
 *
 ***********************/
	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = ""; 
	switch($typeRequest){
		case('insert'): 
			$description = mysqli_real_escape_string(connect(),$data[0]);
			$k = "insert into UnitTest (description) values ('$description')"; break;
		case('update'): 
			$description = mysqli_real_escape_string(connect(),$data[1]);
			$k = "update UnitTest set description = '$description', relations = '$data[2]' where idUT = '$data[0]'"; break;
		case('changeImplementedState'): 
			$implemented = 0; 
			if($data[1] == 'typeSatisfied')
				$implemented = 1;
			$k = "update UnitTest set implemented = '$implemented' where idUT = '$data[0]'"; break;			
		case('delete'): $k = "delete from UnitTest where idUT = '$data[0]'"; break;
	}
	if($k != "") 
	if(!mysqli_query(connect(),$k)) echo "ERR - in(".$typeRequest.")\n".$k;
	else echo $k;
?>
