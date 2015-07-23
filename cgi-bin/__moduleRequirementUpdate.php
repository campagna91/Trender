<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleUpdate">
		<h6 id="moduleUpdateId"><?echo $id;?></h6><?
		$k = "select * from Requisiti where idR = '$id'";
		$q = mysqli_query(connect(),$k) or die("MODUPDATE : (requisiti) ".$k);
		$v = $q->fetch_array();?>
		<label>Descrizione</label>
		<textarea id="moduleUpdateDescription"><?echo $v[2];?></textarea>
		<button id="moduleUpdateSwitchInsideOutsideChapter" class="switch <?
						if($v[5]) echo 'typeInside'; 
						else if($v[3]) echo 'typeChapter'; 
						else echo 'typeOutside';?>" value="<?if($v[5]) echo 'inside'; else if($v[3]) echo 'chapter'; else echo 'outside';?>"><?if($v[5]) echo 'INTERNO'; else if($v[3]) echo 'CAPITOLATO'; else echo 'ESTERNO';?></button>
		<button id="moduleUpdateSatisfied" class="switch <? if($v[6]) echo 'typeSatisfied'; else echo 'typeNotsatisfied';?>" value="<? if($v[6]) echo 'satisfied'; else echo 'notsatisfied';?>">
			<?if($v[6]) echo "SODDISFATTO"; else echo "NON SODDISFATTO";?>
		</button>
		<button id="moduleUpdateUpdate" class="actionUpdate">Salva</button>
	</div><?
}