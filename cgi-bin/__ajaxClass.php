<? 
require_once("__system.php");
$typeRequest = $_POST['typeRequest'];
$data = $_POST['data'];
$k = ""; 
switch($typeRequest){
	case('insert'):
		$data[1] = mysqli_real_escape_string(connect(),$data[1]);
		$data[2] = mysqli_real_escape_string(connect(),$data[2]);
		$data[3] = mysqli_real_escape_string(connect(),$data[3]);
		if(!esiste($data[0], $data[3]))		
			$k = "insert into Classi(titolo,descrizione,utilizzo,idP) values ('$data[0]','$data[1]','$data[2]','$data[3]')";			break;
	case('update'): 
		$data[2] = mysqli_real_escape_string(connect(),$data[2]);
		$data[3] = mysqli_real_escape_string(connect(),$data[3]);
		$data[4] = mysqli_real_escape_string(connect(),$data[4]);
		if($data[0] != $data[1])
		{
			if(!esiste($data[1], $data[4]))
				$k = "update Classi set titolo = '$data[1]', descrizione = '$data[2]', utilizzo = '$data[2]', idP = '$data[4]' where titolo = '$data[0]'";
		}
		else	
			$k = "update Classi set descrizione = '$data[2]', utilizzo = '$data[3]', idP = '$data[4]' where titolo = '$data[0]'"; break;
	case('relationInsert'): 
		$uscente = 1; if($data[2] == 'entering') $uscente = 0; 
		$k = "insert into ClassRelactions values ('$data[0]','$data[1]',$uscente, '$data[3]')";			break;
	case('relationDelete'): 
		$k = "delete from ClassRelactions where classA = '$data[0]' and classB = '$data[1]'";			break;
	case('relationUpdate'): 
		$uscente = 1; if($data[2] == 'entering') $uscente = 0; 
		$k = "update ClassRelactions set uscente = $uscente where classA = '$data[0]' and classB = '$data[1]'";
		break;
	case('relationUpdateType'):
		$uscente = 1; if($data[2] == 'entering') $uscente = 0; 
		$k = "update ClassRelactions set type = '$data[3]' where classA = '$data[0]' and classB = '$data[1]' and uscente = $uscente"; break;
	case('interactionInsert'): 
		$data[2] = mysqli_real_escape_string(connect(),$data[2]);
		$k = "insert into ClassInteractions values ('$data[0]','$data[1]','$data[2]')";			break;
	case('interactionDelete'): 
		$k = "delete from ClassInteractions where classA = '$data[0]' and classB = '$data[1]'";			break;
	case('interactionUpdate'): 
		$data[2] = mysqli_real_escape_string(connect(),$data[2]);
		$k = "update ClassInteractions set interazione = '$data[2]' where classA = '$data[0]' and classB = '$data[1]'";			break;
	case('delete'):
		$k = "delete from Classi where titolo = '$data[0]'";
		$q = mysqli_query(connect(),$k) or die("CLASS (delete) ".$k);
		break;
	case('inheritanceInsert'):
		$k = "insert into Inheritance (super,sub) values ('$data[1]','$data[0]');"; break;
	case('inheritanceDelete'):
		$k = "delete from Inheritance where sub = '$data[0]' and super = '$data[1]'"; break;
	case('attributeInsert'):
		$data[3] = mysqli_real_escape_string(connect(),$data[3]);
		$k = "insert into ClassAttribute (class, attribute, type, description) values ('$data[0]','$data[1]', '$data[2]','$data[3]')"; break;
	case('attributeDelete'):
		$k = "delete from ClassAttribute where class = '$data[0]' and attribute = '$data[1]'"; break;
	case('attributeUpdate'):
		$data[2] = mysqli_real_escape_string(connect(),$data[2]);
		$k = "update ClassAttribute set description = '$data[2]' where attribute = '$data[1]' and class = '$data[0]'"; break;
	case('methodInsert'):
		$data[3] = mysqli_real_escape_string(connect(),$data[3]);
		$data[4] = mysqli_real_escape_string(connect(),$data[4]);
		$k = "insert into ClassMethod (class, signature, returnType, description, params) values ('$data[0]', '$data[1]','$data[2]', '$data[3]', '$data[4]')"; break;
	case('methodDelete'):
		$k = "delete from ClassMethod where class = '$data[0]' and signature = '$data[1]'"; break;
	case('methodUpdate'):
		$data[2] = mysqli_real_escape_string(connect(),$data[2]);
		$data[4] = mysqli_real_escape_string(connect(),$data[4]);
		$k = "update ClassMethod set returnType = '$data[1]', description = '$data[2]', params = '$data[4]' where class = '$data[0]' and signature = '$data[3]'"; break;
}
if($k != "") 
		if(!mysqli_query(connect(),$k)) echo "ERR - in(".$typeRequest.")\n".$k;
		else echo $k;
?>
		