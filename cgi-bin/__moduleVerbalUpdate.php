<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleUpdate">
		<h6 id="moduleUpdateId"><?echo $id;?></h6><?
		$k = "select * from Verbali where data = '$id' ";
		$q = mysqli_query(connect(),$k)or die("MODUPDATE : (verbali) ".$k);
		$v = $q->fetch_array();?>
		<textarea id="moduleUpdateText"><?echo $v[1];?></textarea>
		<button id="moduleUpdateUpdate" class="actionUpdate">Salva</button>
	</div><?
}