<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleChild">
		<table><?
			$k = "select * from CasiUso where padre = '$id' ORDER BY LENGTH(idUC)";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (usecase) ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<? echo $v[0];?>">
					<td><button class="moduleChildDelete actionDelete">-</button></td>
					<td><? echo $v[0]; ?></td>
				</tr><?
			}?>
		</table>
	</div><?
}