<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleActor">
		<select id="moduleActorAssociated"><?
			$k = "select idA from Attori where idA not in ( select idA from AttoriCasiUso where idUC = '$id' ) "; 
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
			while($v = $q->fetch_array())
			{?>
				<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
			}?>
		<select>
		<button id="moduleActorInsert" class="actionInsert">Associa</button>
		<table><?
			$k = "select idA from AttoriCasiUso where idUC = '$id' ";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[0];?>">
					<td><button class="moduleActorDelete actionDelete">-</button></td>
					<td><?echo $v[0];?></td>
				</tr><?
			}?>
		</table>
	</div><?
}