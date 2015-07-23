<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];
	$class = $_POST['class'];
	$methods = array();
	$relations = array();
	$associated = array();
	$final = array();

	$kC = "select signature from ClassMethod where class = '$class'";
	$qC = mysqli_query(connect(), $kC) or die("ERR ".$kC);
	while($vC = $qC->fetch_array())
		array_push($methods, $vC[0]);

	// seleziono i metodi del test 
	$kP = "select relations from UnitTest where idUT = '$id'";
	$qP = mysqli_query(connect(), $kP) or die("ERR ".$kP);
	$vP = $qP->fetch_array();
	$relations = explode(";", $vP[0]);

	// calcolo il metodo
	foreach($relations as $key)	{
		$tmp = explode(".", $key);
		if($tmp[0] == $class)
			array_push($associated, $tmp[1]);
	}

	// la differenza son i metodi restanti
	$final = array_diff($methods, $associated);
	print_r($final);

	foreach($final as $key)
	{?>	
		<option value="<?echo $key;?>"><?echo $key;?></option><?
	}
}