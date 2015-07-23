<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleChild">
		<table><?
			$k = "select * from Requisiti where padre = '$id' order by length(idR)";
			$q = mysqli_query(connect(),$k) or die("MODUDPATE : (requisiti) ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[0];?>">
					<td><button class="moduleChildDelete actionDelete">-</button></td>
					<td><?echo $v[0];?></td>
				</tr><?
			}?>
		</table>
	</div><?
}