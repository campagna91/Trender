<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleChild">
		<table><?
			$k = "select titolo from Package where padre = '$id'";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (package)".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[0];?>">
					<td><button class="moduleChildDelete actionDelete">-</button>
					<td><?echo $v[0];?></td>
				</tr><?
			}?>
		</table>
	</div><?
}