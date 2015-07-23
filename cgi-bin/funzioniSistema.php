<?
/************************
 *	CONNESSIONE AL DATABASE 
 ************************/

function connect(){
	$link = mysqli_connect("localhost","root","infinit3ch","Premi") or die("Error " . mysql_error()); 
	return $link; 
}

/************************
 *	LOGIN UTENTE 
 ************************/

function login($user,$pass){
	$link = connect();

	$q = "SELECT * FROM Admin WHERE username = '$user' AND pwd = '$pass' ";
	$result = mysqli_query($link,$q) or die("err");
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
/************************
 *	LOGOUT REQUEST
 ************************/

function logout(){ 
	if(isset($_GET['logout'])){	?>
		<script>location.href="index.php"; </script>	<?
		session_destroy();
	}

}

/************************
 *	NEED FOR PRINT INHERITANCE OF ID 
 ************************/

function stampaAnnidamento($id){
	$p = explode(".",$id); $n = 1; $a="";
	while($n<count($p)) { $a .= "-"; $n++; } return $a.$id;
}

/************************
 *	CHECK IF EXIST THE INSERT ID 
 ************************/
function esiste($id){
	$page = basename($_SERVER['PHP_SELF']);
	$k = "";
	$query = "NONE";
	switch($page) {
		case('requisiti.php'):
			$k = "select idR from Requisiti where idR = '$id'";
		break;
		case('casiuso.php'):
			$k = "select idUC from CasiUso where idUC = '$id'";
		break;
		case('attori.php'):
		case('__ajaxAttori.php'):
			$k = "select idA from Attori where idA = '$id'";
		break;
		case('verbali.php'):
		case('__ajaxVerbali.php'):
			$k = "select * from Verbali where data = CAST('$id' AS DATE)";
			break;
		case('package.php'):
		case('__ajaxPackage.php'):
			$k = "select * from Package where titolo = '$id'";
			break;
		case('classi.php'):
		case('__ajaxClass.php'):
			$k = "select * from Classi where titolo = '$id'";
			break;
	}
	system("echo $page >> /Users/champ/logs");
	system("echo '$query' >> /Users/champ/logs");
	$q = mysqli_query(connect(), $k)or die("non esiste err ".$k);
	if($q && mysqli_num_rows($q)>0) return true;
	return false; 
}


/************************
 *	REQUEST FOR MAINTENANCE OF SERVICE
 ************************/
global $manutenzione;
$manutenzione=0;
if($manutenzione==1) {?><script>location.href="lavorandoPerVoi.html"</script><?}?>