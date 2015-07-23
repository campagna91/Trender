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
			$padre = "NULL"; if($data[0] != "Nessuno") $padre = $data[0];
			$importanza = $data[1];
			$tipo = $data[2];
			$descrizione = mysqli_real_escape_string(connect(),$data[3]);
			$insideOutside = 0; $chapter = 0; 
			if($data[4] == 'inside') $insideOutside = 1;
			if($data[4] == 'chapter') $chapter = 1; 
			if($padre != "NULL")
			{
				$k = "SELECT IDMAX FROM (
						SELECT CAST(SUBSTR(idR,LENGTH('$padre')+2,LENGTH(idR)) AS UNSIGNED) AS IDMAX
						FROM Requisiti
						WHERE padre = '$padre'
						ORDER BY IDMAX DESC ) 
					AS REQUISITIMAX
					LIMIT 1";
				$q = mysqli_query(connect(),$k) or die("REQUIREMENT: (new) ".$k);
				$v = $q->fetch_array();
				$last = $v[0]+1;					
				$newId = 'R'.$importanza.substr($padre,2,strlen($padre)).".".$last;
				$k = "INSERT INTO Requisiti(idR,padre,descrizione,capitolato,interno) VALUES ('$newId','$padre','$descrizione',$chapter,$insideOutside) ";
			} else {
				$k = "SELECT IDMAX FROM ( 
							SELECT CAST(SUBSTR(idR,4,LENGTH(idR)) AS UNSIGNED) AS IDMAX 
							FROM Requisiti 
							WHERE SUBSTR(idR,3,1) = '$tipo' 
							ORDER BY IDMAX DESC ) 
						AS REQUISITIMAX 
						LIMIT 1";
						$q = mysqli_query(connect(),$k) or die("REQUIREMENT: (new) ".$k);
				$v = $q->fetch_array();
				$last = $v[0]+1;
				$newId = "R".$importanza.$tipo.$last;
				$k = "INSERT INTO Requisiti(idR,descrizione,capitolato,interno) VALUES ('$newId','$descrizione',$chapter,$insideOutside) ";
			}			break;
		case('update'):
			$data = $_POST['data'];
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$insideOutside = 0; $chapter = 0; 
			if($data[2] == 'inside') $insideOutside = 1;
			if($data[2] == 'chapter') $chapter = 1; 
			if($data[3] == 'notsatisfied') $data[3] = 0; else $data[3] = 1; 
			$k = "UPDATE Requisiti SET 
					descrizione = '$data[1]',
					interno = $insideOutside,
					capitolato = $chapter,
					soddisfatto = $data[3]
					WHERE idR = '$data[0]' ";			break;
		case('delete'):
			$k = "delete from Requisiti where idR = '$data[0]'";			
			$trigger = mysqli_query(connect(), "delete from Test where object = '$data[0]'")or die("ERR");	break;
		case('usecaseInsert'):
			$k = "insert into RequisitiCasiUso (idR,idUC) values ('$data[0]','$data[1]')";			break;
		case('verbalInsert'):
			$k = "insert into RequisitiVerbali (idR,idV) values ('$data[0]','$data[1]')";			break;
		case('usecaseDelete'):
			$k = "delete from RequisitiCasiUso where idR='$data[0]' and idUC='$data[1]';";			break;
		case('verbalDelete'):
			$k = "delete from RequisitiVerbali where idR = '$data[0]' and idV = '$data[1]'";			break;
		case('testValidationInsert'):
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "insert into RequirementTest values('validation','$data[0]','$data[1]')";	break;
		case('testValidationUpdate'):
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "update RequirementTest set description = '$data[1]' where object = '$data[0]' and type = 'validation'"; break;
		case('testSystemUpdate'):
			$implemented = 0; if($data[2] == 'satisfied') $implemented = 1; 
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "update RequirementTest set description = '$data[1]', implemented ='$implemented' where object = '$data[0]' and type = 'system'";	break;
		case('testSystemInsert'):
			$implemented = 0; if($data[2] == 'satisfied') $implemented = 1; 
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "insert into RequirementTest values ('system','$data[0]','$data[1]',$implemented)";	break;
		case('packageInsert'):
			$k = "insert into PackageRequirement(idP, idR) values ('$data[1]', '$data[0]')";	break;
		case('packageDelete');
			$k = "delete from PackageRequirement where idR = '$data[0]' and idP = '$data[1]'";	break;
		case('classInsert'):
			$k = "insert into RequirementClass (idR, idC, idP) values ('$data[0]', '$data[1]', '$data[2]')"; break;
		case('classDelete'):
			$k = "delete from RequirementClass where idR = '$data[0]' and idC = '$data[1]' and idP = '$data[2]'"; break;
	}
	if($k != "") 
		if(!mysqli_query(connect(),$k)) echo "ERR - in(".$typeRequest.")\n".$k;
		else echo $k;

?>