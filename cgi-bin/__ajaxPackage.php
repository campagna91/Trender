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
			$data[2] = mysqli_real_escape_string(connect(),$data[2]);
			$data[3] = mysqli_real_escape_string(connect(),$data[3]);
			if($data[1] != "Nessuno")
			{
				if(!esiste($data[0]))
					$k = "insert into Package (titolo,padre,descrizione,immagine) value('$data[0]','$data[1]','$data[2]','$data[3]')";
				else break;
			} else 
				$k = "insert into Package (titolo,padre,descrizione,immagine) value('$data[0]',NULL,'$data[3]','$data[2]')";			
				break;
		case('update'):
			$data[2] = mysqli_real_escape_string(connect(),$data[2]);
			$data[3] = mysqli_real_escape_string(connect(),$data[3]);
			if($data[0] != $data[1])
			{
				if(!esiste($data[0]))
				{
					$k = "update Package set titolo = '$data[0]', immagine = '$data[2]', descrizione = '$data[3]' where titolo = '$data[1]'";
				}
			} else $k = "update Package set immagine = '$data[2]', descrizione = '$data[3]' where titolo = '$data[1]'"; 			
			break;
		case('requirementInsert'): 
			$k = "insert into PackageRequirement values('$data[0]','$data[1]')";			break;
		case('interactionInsert'):
			$data[2] = mysqli_real_escape_string(connect(),$data[2]);
			$k = "insert into PackageInteractions values ('$data[0]','$data[1]','$data[2]')";			break;
		case('interactionDelete'): 
			$k = "delete from PackageInteractions where packageA = '$data[0]' and packageB = '$data[1]'";			break;
		case('delete'): 
			$k = "delete from Package where titolo = '$data[0]' ";			
			$q = mysqli_query(connect(),"delete from Test where object = '$data[0]'") or die ("err code cery"); break;
		case('requirementDelete'): 
			$k = "delete from PackageRequirement where idR = '$data[1]' and idP = '$data[0]'";			break;
		case('interactionUpdate'): 
			$data[2] = mysqli_real_escape_string(connect(),$data[2]);
			$k = "update PackageInteractions set interaction = '$data[2]' where packageA = '$data[0]' and packageB = '$data[1]'";			break;
		case('testIntegrationInsert'):
			$implemented = 1; if($data[2] == 'notSatisfied') $implemented = 0; 
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "insert into Test values ('integration','$data[0]','$data[1]','$data[2]')"; break;
		case('testIntegrationUpdate'):
			$implemented = 1; if($data[2] == 'notSatisfied') $implemented = 0; 
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "update Test set description = '$data[1]', implemented = '$implemented' where object = '$data[0]'"; break;
	}
	if($k != "") 
		if(!mysqli_query(connect(),$k)) echo "ERR - in(".$typeRequest.")\n".$k;
		else echo $k;
?>
