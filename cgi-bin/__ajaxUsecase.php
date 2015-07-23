<?
	require_once('__system.php');

	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = "";
	switch($typeRequest){
		case('insert'):
			$padre = $data[0];
			$estensione = 0; $inclusione = 0;
			if($data[1] == 'extension') $estensione = 1; 
			if($data[1] == 'inclusion') $inclusione = 1;
			$erede = 0; if($data[2] == 'heir') $erede = 1; 
			$titolo = mysqli_real_escape_string(connect(),$data[3]);
			$descrizione = mysqli_real_escape_string(connect(),$data[4]);
			$precondizione = mysqli_real_escape_string(connect(),$data[5]);
			$postcondizione = mysqli_real_escape_string(connect(),$data[6]);
			$didascalia = mysqli_real_escape_string(connect(),$data[7]);
			$scenario = mysqli_real_escape_string(connect(),$data[8]);
			$scenarioAlternativo = mysqli_real_escape_string(connect(),$data[9]);
			$path = mysqli_real_escape_string(connect(),$data[10]);
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
		if($data[1] == 'none'){ $inclusione = 0; $estensione = 0;}
		if($data[1] == 'inclusion'){ $inclusione = 1; $estensione = 0;}
		if($data[1] == 'extension'){ $inclusione = 0; $estensione = 1;}
		$erede = 0; if($data[2] == 'heir') $erede = 1; 
		$data[3] = mysqli_real_escape_string(connect(),$data[3]);
		$data[4] = mysqli_real_escape_string(connect(),$data[4]);
		$data[5] = mysqli_real_escape_string(connect(),$data[5]);
		$data[6] = mysqli_real_escape_string(connect(),$data[6]);
		$data[7] = mysqli_real_escape_string(connect(),$data[7]);
		$data[8] = mysqli_real_escape_string(connect(),$data[8]);
		$data[9] = mysqli_real_escape_string(connect(),$data[9]);
		
		$k = "update CasiUso set 
			titolo='$data[3]',
			descrizione='$data[4]',
			pre='$data[5]',
			post='$data[6]',
			didascalia='$data[7]',
			erede = $erede,
			estensione = $estensione,
			scenario = '$data[8]',
			scenarioAlternativo = '$data[9]',
			image = '$data[10]',
			inclusione = $inclusione where idUC = '$data[0]' ";
		break;
	case('delete'):
		$k = "delete from CasiUso where idUC = '$data[0]'";		break;
	case('childDelete'):
		$k = "delete from CasiUso where idUC = '$data[0]'"; break;
	case('actorInsert'):
		$k = "insert into AttoriCasiUso value('$data[1]','$data[0]')";		break;
	case('actorDelete'):
		$k = "delete from AttoriCasiUso where idA = '$data[1]' and idUC = '$data[0]'";		break;
	case('requirementInsert'):
		$k = "insert into RequisitiCasiUso(idUC,idR) values('$data[0]','$data[1]')";		break;
	case('requirementDelete'):
		$k = "delete from RequisitiCasiUso where idR = '$data[1]' and idUC = '$data[0]'";		break; 
	case('relationAddVerbali'):
		$k = "insert into CasiUsoVerbali values ('$data[0]','$data[1]')";		break;
	case('relationDeleteVerbali'):
		$k = "delete from CasiUsoVerbali where idV = '$data[1]' and idUC = '$data[0]'";		break;
	}
	if($k != "") 
		if(!mysqli_query(connect(),$k)) echo "ERR - in(".$typeRequest.")\n".$k;
		else echo $k;
?>