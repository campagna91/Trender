<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleVerbal">
		<select id="moduleVerbalName"><?
			$k = "select data from Verbali where data not in ( select idV from CasiUsoVerbali where idUC = '$id' ) ";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
			while($v = $q->fetch_array())
			{?>
				<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
			}?>
		</select>
		<button id="moduleVerbalInsert" class="actionInsert">Associa</button>
		<table><?
			$k = "select idV from CasiUsoVerbali where idUC = '$id' ";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<? echo $v[0];?>">
					<td><button class="moduleVerbalDelete actionDelete">-</button>
					<td><?echo $v[0];?></td>
				</tr><?
			}?>
		</table>
	</div><?
}