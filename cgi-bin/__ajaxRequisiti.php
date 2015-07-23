<? 
require_once("funzioniSistema.php");
/***********************
 *
 *	SWITCH BETWEEN TYPE OF REQUEST ABOUT REQUISITE 
 *
 ***********************/
	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = ""; 
	switch($typeRequest){
		case('new'):
			$padre = "NULL"; if($data[0] != "Nessuno") $padre = $data[0];
			$importanza = $data[1];
			$tipo = $data[2];
			$descrizione = mysqli_real_escape_string(connect(),$data[3]);
			$inside; $outside; 
			if($data[4] == 'true') $inside = 1; else $inside = 0; 
			if($inside == 1) $outside = 0; else $outside = 1; 
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
				$k = "INSERT INTO Requisiti(idR,padre,descrizione,capitolato,interno) VALUES ('$newId','$padre','$descrizione',$outside,$inside) ";
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
				$k = "INSERT INTO Requisiti(idR,descrizione,capitolato,interno) VALUES ('$newId','$descrizione',$outside,$inside) ";
			}			break;
		case('update'):
			$data = $_POST['data'];
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "UPDATE Requisiti SET 
					descrizione = '$data[1]',
					interno = $data[2],
					capitolato = $data[3],
					soddisfatto = $data[4]
					WHERE idR = '$data[0]' ";			break;
		case('delete'):
			$k = "delete from Requisiti where idR = '$data[0]'";			break;
		case('relationAddUseCase'):
			$k = "insert into RequisitiCasiUso (idR,idUC) values ('$data[0]','$data[1]')";			break;
		case('relationAddVerbale'):
			$k = "insert into RequisitiVerbali (idR,idV) values ('$data[0]','$data[1]')";			break;
		case('relationDeleteUseCase'):
			$k = "delete from RequisitiCasiUso where idR='$data[0]' and idUC='$data[1]';";			break;
		case('relationDeleteVerbali'):
			$k = "delete from RequisitiVerbali where idR = '$data[0]' and idV = '$data[1]'";			break;
	}
	if($k != "") $q = mysqli_query(connect(),$k) or die("Err ".$typeRequest."\n$k");

?>