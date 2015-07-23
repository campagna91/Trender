<?
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id']; ?>
	<div id="moduleUpdate">
		<h6 id="moduleUpdateId"><?echo $id;?></h6><?
		$k = "select * from Package where titolo = '$id'";
		$q = mysqli_query(connect(),$k) or die('__modulePackageUpdate.php '.$k);
		$v = $q->fetch_array();?>
		<label>Nome</label>
		<textarea id="moduleUpdateName"><? 
			$name = explode("::",$v[0]);
			echo $name[count($name)-1];?></textarea>
		<label>Path immagine</label>
		<textarea id="moduleUpdatePath"><? echo $v[1];?></textarea>
		<label>Descrizione</label>
		<textarea id="moduleUpdateDescription"><? echo $v[2]; ?></textarea>
		<button id="moduleUpdateUpdate" class="actionUpdate">Salva</button>
	</div><?
}