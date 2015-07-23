<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="modulePackage">
		<select id="modulePackageAssociated"><?
			$k = "select titolo from Package where titolo not in ( select idP from PackageRequirement where idR = '$id') order by titolo";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (package)".$k);
			while($v = $q->fetch_array())
			{?>
				<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
			}?>
		</select>
		<button id="modulePackageInsert" class="actionInsert">Associa</button>
		<table><?
			$k = "select idP from PackageRequirement where idR = '$id' order by idP";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (requirement)".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[0];?>">
					<td><button class="modulePackageDelete actionDelete">-</button>
					<td><?echo $v[0];?></td>
				</tr><?
			}?>
		</table>
	</div><?
}