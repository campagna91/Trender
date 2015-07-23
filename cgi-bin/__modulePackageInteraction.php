<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleInteraction">
		<select id="moduleInteractionPackage"><?
			$k = "select titolo from Package where titolo != '$id' and titolo not in ( select packageB from PackageInteractions where packageA = '$id') order by length(titolo),titolo ";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (packageInteractions)".$k);
			while($v = $q->fetch_array())
			{?>
				<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
			}?>
		</select>
		<label>Descrizione</label>
		<textarea id="moduleInteractionDescription"></textarea>
		<button id="moduleInteractionInsert" class="actionInsert">Associa</button>
		<table><?
			$k = "select * from PackageInteractions where packageA = '$id' ";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (packageInteractions)".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[1];?>">
					<td><button class="moduleInteractionDelete actionDelete">-</button></td>
					<td><?echo $v[1];?></td>
					<td><textarea class="moduleInteractionDescription"><?echo $v[2];?></textarea></td>
					<td><button class="moduleInteractionUpdate actionUpdate">Save</button></td>
				</tr><?
			}?>
		</table>
	</div><?
}