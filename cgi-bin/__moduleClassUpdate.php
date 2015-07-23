<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];
	$k = "select * from Classi where titolo = '$id';";
	$q = mysqli_query(connect(),$k) or die("err update");
	$vClass = $q->fetch_array();?>
	<div id="moduleUpdate">
		<h6 id="moduleUpdateIdP"><?echo $vClass[3];?></h6>::<h6 id="moduleUpdateId"><?echo $id;?></h6>

		<select id="moduleUpdatePackage"><?
		$k = "select * from Package";
		$q = mysqli_query(connect(), $k) or die('errore reperimento package');
		while($v = $q->fetch_array())
		{?>
			<option value="<?echo $v[0]?>" <?if($v[0] == $vClass[3]) echo "selected=selected";?> ><?echo $v[0];?></option><?
		}?>
		<textarea id="moduleUpdateName"><?echo $id;?></textarea>
		<label>Descrizione</label>
		<textarea id="moduleUpdateDescription"><?echo $vClass[1];?></textarea></td>
		<label>Uso</label>
		<textarea id="moduleUpdateUse"><?echo $vClass[2];?></textarea></td>
		<button id="moduleUpdateUpdate" class="actionUpdate">Salva</button>
	</div><?
}