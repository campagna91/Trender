<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleUpdate">
		<h6 id="moduleUpdateId"><?echo $id;?></h6><?
		$k = "select * from CasiUso where idUC = '$id' ";
		$q = mysqli_query(connect(),$k) or die ("MODUPDATE : (usecase) ".$k);
		$v = $q->fetch_array();?>
		<button id="moduleUpdateSwitchExtensionInclusion" class="switch 
						<?if($v[4]) echo'typeExtension'; if($v[5]) echo 'typeInclusion'; if(!$v[4] && !$v[5]) echo 'typeNone';?>" 
						value="<?if($v[4]) echo'extension'; if($v[5]) echo 'inclusion'; if(!$v[4] && !$v[5]) echo 'none';?>">
						<?if($v[4]) echo "ESTENSIONE"; if($v[5]) echo "INCLUSIONE"; if(!$v[4] && !$v[5]) echo 'NESSUNA RELAZIONE';?></button>
		<button id="moduleUpdateSwitchEredeNonerede" class="switch <?if($v[6]) echo 'typeHeir';else echo 'typeNotHeir';?>" value="<?if($v[6]) echo 'heir';else echo 'notHeir';?>"><?if($v[6]) echo "EREDE"; else echo "NON EREDE";?></button>
		<label>Titolo</label>
		<textarea id="moduleUpdateTitle"><?echo $v[2];?></textarea>
		<label>Descrizione</label>
		<textarea id="moduleUpdateDescription"><?echo $v[3];?></textarea>
		<label>Precondizioni</label>
		<textarea id="moduleUpdatePrecondition"><?echo $v[7];?></textarea>
		<label>Postcondizioni</label>
		<textarea id="moduleUpdatePostcondition"><?echo $v[8];?></textarea>
		<label>Didascalia</label>
		<textarea id="moduleUpdateDidascalia"><?echo $v[10];?></textarea>
		<label>Scenario</label>
		<textarea id="moduleUpdateScenario"><? echo $v[11];?></textarea>
		<label>Scenario Alternativo</label>
		<textarea id="moduleUpdateAlternativeScenario"><?echo $v[12];?></textarea>	
		<label>Path immagine</label>
		<textarea id="moduleUpdatePath"><? echo $v[9];?></textarea>
		<button id="moduleUpdateUpdate" class="actionUpdate">Salva</button>
	</div><?
}