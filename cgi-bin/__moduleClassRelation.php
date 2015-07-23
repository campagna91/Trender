<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleRelation">
		<select id="moduleRelationAssociated"><?
			$k = "select titolo, idP from Classi where titolo not in ( 
				select classB from ClassRelactions where classA = '$id') ";
			$q = mysqli_query(connect(),$k) or die("err module Realtion Associated");
			while($v = $q->fetch_array())
			{?>
				<option value="<?echo $v[0];?>"><?echo $v[0]."($v[1])";?></option><?
			}?>
		</select>
		<button id="moduleRelationSwitchEnteringOutgoing" class="switch" value="entering">ENTRANTE</button>
		<button id="moduleRelationSwitchType" class="switch" value="association">ASSOCIAZIONE</button>
		<button id="moduleRelationInsert" class="actionInsert">Relaziona</button>
		<table><?
			$k = "select * from ClassRelactions where classA = '$id'";
			$q = mysqli_query(connect(),$k) or die("err class relations");
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[1];?>">
					<td><button class="moduleRelationDelete actionDelete">-</button></td>
					<td><?echo $v[1];?></td>
					<td><button class="moduleRelationSwitchEnteringOutgoing switch" value="<?if($v[2]) echo 'outgoing'; else echo 'entering';?>"><?if($v[2]) echo 'USCENTE'; else echo 'ENTRANTE';?></button></td>
					<td><button class="moduleRelationSwitchType switch" value="<?echo $v[3]?>"><?echo nameType($v[3]);?></button>
				</tr><?
			}?>
	</div><?
}
function nameType($value) {
	switch($value) 
	{
		case('navigable-association'): return 'ASSOCIAZIONE NAVIGABILE'; break;
		case('aggregation'): return 'AGGREGAZIONE'; break;
		case('composition'): return 'COMPOSIZIONE'; break;
		case('dependency'): return 'DIPENDENZA'; break;
		case('relization'): return 'REALIZZAZIONE'; break;
		case('association'): return 'ASSOCIAZIONE'; break;
	}
}