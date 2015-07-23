<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleUpdate">
		<h6 id="moduleUpdateId"><?echo $id;?></h6>
		<label>Nome attore</label>
		<textarea id="moduleUpdateName"><?echo $id;?></textarea>
		<button id="moduleUpdateUpdate" class="actionUpdate">Salva</button>
	</div><?
}