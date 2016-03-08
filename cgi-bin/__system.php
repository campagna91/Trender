<?
function connect(){
	$link = mysqli_connect('localhost','root','','Trender','3306') or die("Error " . mysql_error()); 
	return $link; 
}
function login($user,$pass){
	$link = connect();

	$q = "SELECT * FROM Admin WHERE username = '$user' AND password = '$pass' ";
	$result = mysqli_query($link,$q) or die("err ".$q);
	if($result){
		$r = mysqli_num_rows($result);
		if($r > 0) return true;
		else return false; 
	} else {
		$message  = 'Invalid query: ' . mysql_error() . "\n";
      	$message .= 'Whole query: ' . $q;
    	die($message);
    	return false; 
	}
}
function logged() {
	if(!isset($_SESSION['user']) || $_SESSION['user']== "") { ?>
		<script>location.href="index.php"; </script> <?
	}	
}
function logout(){ 
	if(isset($_GET['logout'])){	?>
		<script>location.href="index.php"; </script>	<?
		session_destroy();
	}
}
function printNesting($id){
	$n = explode(".", $id);
	$aux = "";
	$num = count($n);
	for($i = 1; $i < $num; $i++) {
		$aux = $aux . ' - ';
	}
	return $aux.$id;
}
function testIsSet($id){
	/*
		ritorna se i test pertinenti l'id passato sono completi. 
		più nello specifico ritorna per i padri i valori: 
			0 - se nessun test è settato
			1 - se solo uno dei due è settato e quindi vi è una mancanza
			2 - se tutti i test son stati settati
		mentre per i soli figli ritorna i valori 
			0 - se nessun test è stato settato
			2 - se tutti i test son stati settati
	*/
	$idSplit = explode(".",$id);
	$dad = 0; if(count($idSplit) == 1) $dad = 1; 
	if(!$dad){
		$kv = "select * from Test where object = '$id' and type='validation'";
		$q = mysqli_query(connect(),$kv) or die("chlid");
		if(mysqli_num_rows($q) == 1) return 2;
		else return 0;
	} else {
		$k = "select * from Test where object = '$id'";
		$q = mysqli_query(connect(),$k);
		return mysqli_num_rows($q);
	}
}


function esiste($id, $package = ''){
	$page = basename($_SERVER['PHP_SELF']);
	$k = "";
	switch($page) {
		case('requirements.php'):
		case('__ajaxRequirements.php'):
		case('__moduleRequirements.js'):
			$k = "select requirement from Requirements where requirement = '$id'";
			break;
		case('usecases.php'):
		case('__ajaxUsecases.php'):
		case('__moduleUsecases.js'):
			$k = "select usecase from Usecases where usecase = '$id'";
			break;
		case('actors.php'):
		case('__ajaxActors.php'):
		case('__moduleActors.js'):
			$k = "select actor from Actors where actor = '$id'";
			break;
		case('verbals.php'):
		case('__ajaxVerbals.php'):
		case('__moduleVerbals.js'):
			$k = "select date from Verbals where date = CAST('$id' AS DATE)";
			break;
		case('packages.php'):
		case('__ajaxPackages.php'):
		case('__modulePackages.js'):
			$k = "select package from Packages where package = '$id'";
			break;
		case('classes.php'):
		case('__ajaxClasses.php'):
		case('__moduleClasses.js'):
			if($package != '')
				$k = "select class from Classes where package = '$package' and class = '$id'";
			else 
				return false;
			break;
		case('unitTests.php'):
			$k = "select test from UnitTests where test = '$id'";
			break;
		case('glossary.php'):
		case('__ajaxGlossary.php'):
			$k = "select term from Glossary where term = '$id'";
			break;
	}
	system("echo $page >> /Users/champ/logs");
	system("echo '$k' >> /Users/champ/logs");
	$q = mysqli_query(connect(), $k)or die("non esiste err ".$k);
	if($q && mysqli_num_rows($q)>0) return true;
	return false; 
}
global $manutenzione;
$manutenzione=0;
if($manutenzione==1) {?><script>location.href="lavorandoPerVoi.html"</script><?}?>