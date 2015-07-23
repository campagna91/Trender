<? 
require_once('__system.php');
if(isset($_POST['id']))
{	
	$id = $_POST['id'];?>
	<div id="moduleInheritance">
		<label>Estende</label>
		<select id="moduleInheritanceExtended"><?
			$k = "select titolo from Classi where titolo not in (select super from Inheritance where sub = '$id') and titolo != '$id'";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE: (detailsClassInheritance)".$k);
			while($v = $q->fetch_array())
			{?>
				<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
			}?>
		</select>
		<button id="moduleInheritanceInsert" class="actionInsert">Aggiungi class base</button>	
		<table><?
			$k = "select * from Inheritance where sub = '$id'";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE: (detailsClasInheritanceList)".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[0];?>">
					<td><button class="moduleInheritanceDelete actionDelete">-</button></td>
					<td><? echo $v[0]; ?></td>
				</tr><?
			}?>
		</table>
		Derivate:<br><?
		$k = "select * from Inheritance where super = '$id'";
		$q = mysqli_query(connect(), $k)or die("err inheritance print");
		while($v = $q->fetch_array())
		{?>
			<button class="actionDelete" style="display:inline"><?echo $v[1];?></button><?
		}?>
	</div><?
}