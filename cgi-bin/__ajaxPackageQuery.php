<?
	require_once('funzioniSistema.php');

	$typeRequest = $_POST['typeRequest'];
	$data = $_POST['data'];
	$k = "";
	switch($typeRequest){
		case('packageEfferente'):
			$aux = EF($data[0]);
		case('packageAfferent'):
			$aux = AF($data[0]);
		case('packageInstability'):
			$ef = EF($data[0]);
			$aux = $ef / ( AF($data[0]) + $ef);
	}
	echo $aux;

	function EF($idP) {
		$kEF = "select classA, classB from ClassRelactions where classA in ( select titolo from Classi where idP = '$data[0]') and classB not in ( select titolo from Classi where idP = '$data[0]')";
		$qEF = mysqli_query(connect(), $kEF) or die("errore selezine classi esterne al package");
		$numEF = mysqli_num_rows($qEF);
		return $numEF;
	}
	function AF($idP) {
		$kAF = "select classA, classB from ClassRelactions where classA not in (select titolo from Classi where idP = '$idP') and classB in (select titolo from Classi where idP = '$idP')";
		$qAF = mysqli_query(connect(), $kAF);
		$numAF = mysqli_num_rows($qAF);
		return $numAF;
	}
?>