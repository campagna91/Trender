<?
	require_once('funzioniSistema.php');

	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = "";
	switch($typeRequest){
		case('new'):
			$padre = 'Nessuno'; if($data[0] != 'Nessuno') $padre = $data[0];
			$erede = 0; if($data[1] == 'true') $erede = 1; 
			$estensione = 0; if($data[2] == 'true') $estensione = 1; 
			$inclusione = 0; if($data[3] == 'true') $inclusione = 1; 
			$titolo = mysqli_real_escape_string(connect(),$data[4]);
			$descrizione = mysqli_real_escape_string(connect(),$data[5]);
			$precondizione = mysqli_real_escape_string(connect(),$data[6]);
			$postcondizione = mysqli_real_escape_string(connect(),$data[7]);
			$didascalia = mysqli_real_escape_string(connect(),$data[8]);
			$path = mysqli_real_escape_string(connect(),$data[9]);
			$scenario = mysqli_real_escape_string(connect(),$data[10]);
			$scenarioAlternativo = mysqli_real_escape_string(connect(),$data[11]);
			if($padre != "Nessuno")
			{
				$last=0;
				$k = "SELECT IDMAX FROM (
						SELECT CAST(SUBSTR(idUC,LENGTH('$padre')+2,LENGTH(idUC)) AS UNSIGNED) AS IDMAX
						FROM CasiUso
						WHERE padre = '$padre'
						ORDER BY IDMAX DESC ) 
					AS CASIUSOMAX
					LIMIT 1";
				$q = mysqli_query(connect(),$k) or die("USECASE : (new) ".$k);
				$v = $q->fetch_array();
				$last = $v[0]+1;
				$newId = $padre.".".$last;
				$k= "INSERT INTO CasiUso(idUC,padre,titolo,descrizione,estensione,inclusione,erede,pre,post,image,didascalia,scenario,scenarioAlternativo) 
					VALUES	('$newId','$padre','$titolo','$descrizione',$estensione,$inclusione,$erede,'$precondizione','$postcondizione','$path','$didascalia','$scenario','$scenarioAlternativo')";
			} else {
				$k = "SELECT IDMAX FROM ( 
							SELECT CAST(SUBSTR(idUC,3,LENGTH(idUC)) AS UNSIGNED) AS IDMAX 
							FROM CasiUso 
							ORDER BY IDMAX DESC ) 
						AS CASIUSOMAX
						LIMIT 1";
				$q = mysqli_query(connect(), $k) or die("USECASE : (new) ".$k);
				$v = $q->fetch_array();
				$last = $v[0]+1;
				$newId = "UC".$last;
				$k = "INSERT INTO CasiUso (idUC,titolo,descrizione,estensione,inclusione,erede,pre,post,image,didascalia,scenario,scenarioAlternativo) 
						VALUES ('$newId','$titolo','$descrizione',$estensione,$inclusione,$erede,'$precondizione','$postcondizione','$path','$didascalia','$scenario','$scenarioAlternativo')";
			}
		break;
	case('update'):
		$data = $_POST['data'];
		$data[4] = mysqli_real_escape_string(connect(),$data[4]);
		$data[5] = mysqli_real_escape_string(connect(),$data[5]);
		$data[6] = mysqli_real_escape_string(connect(),$data[6]);
		$data[7] = mysqli_real_escape_string(connect(),$data[7]);
		$data[8] = mysqli_real_escape_string(connect(),$data[8]);
		$data[9] = mysqli_real_escape_string(connect(),$data[9]);
		$data[10] = mysqli_real_escape_string(connect(),$data[10]);
		$data[11] = mysqli_real_escape_string(connect(),$data[11]);
		$k = "update CasiUso set 
			titolo='$data[4]',
			descrizione='$data[5]',
			pre='$data[6]',
			post='$data[7]',
			didascalia='$data[8]',
			image = '$data[9]',
			erede=$data[1],
			estensione=$data[3],
			scenario = '$data[10]',
			scenarioAlternativo = '$data[11]',
			inclusione=$data[2] where idUC = '$data[0]' ";
		break;
	case('delete'):
		$k = "delete from CasiUso where idUC = '$data[0]'";		break;
	case('relationAddActor'):
		$k = "insert into AttoriCasiUso value('$data[1]','$data[0]')";		break;
	case('relationDeleteActor'):
		$k = "delete from AttoriCasiUso where idA = '$data[1]' and idUC = '$data[0]'";		break;
	case('relationAddRequirement'):
		$k = "insert into RequisitiCasiUso(idUC,idR) values('$data[0]','$data[1]')";		break;
	case('relationDeleteRequirement'):
		$k = "delete from RequisitiCasiUso where idR = '$data[1]' and idUC = '$data[0]'";		break; 
	case('relationAddVerbali'):
		$k = "insert into CasiUsoVerbali values ('$data[0]','$data[1]')";		break;
	case('relationDeleteVerbali'):
		$k = "delete from CasiUsoVerbali where idV = '$data[1]' and idUC = '$data[0]'";		break;
	}
	if($k != "") $q = mysqli_query(connect(),$k) or die("Err ".$typeRequest."\n$k");
?>