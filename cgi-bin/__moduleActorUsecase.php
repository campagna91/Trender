<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleUsecase">
		<select id="moduleUsecaseAssociated"><?
			$id = mysqli_real_escape_string(connect(),$id);
			$k = "select idUC from CasiUso where idUC not in ( select idUC from AttoriCasiUso where idA = '$id' ) "; 
			$q = mysqli_query(connect(),$k) or die("MODUDPATE : (actor) ".$k);
			while($v = $q->fetch_array())
				{?>
					<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
				}?>
		</select>
		<button id="moduleUsecaseInsert" class="actionInsert">Associa</button>
		<table><?
		$k = "select * from CasiUso where idUC in ( select idUC from AttoriCasiUso where idA = '$id' )";
		$q = mysqli_query(connect(),$k) or die("MODUPDATE : (actor) ".$k);
		while($v = $q->fetch_array())
		{?>
			<tr class="<?echo $v[0];?>">
				<td><button class="moduleUsecaseDelete actionDelete">-</button></td>
				<td><?echo $v[0];?></td>
					<td><?echo $v[2];?></td>
				</tr><?
			}?>
		</table>
	</div><?
}