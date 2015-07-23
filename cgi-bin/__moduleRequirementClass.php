<? 
require_once('__system.php');
if(isset($_POST['id']))
{
	$id = $_POST['id'];?>
	<div id="moduleClass">
		<select id="moduleClassName"><?
		$k = "select titolo, idP from Classi where titolo not in ( select idC from RequirementClass where idR = '$id') order by titolo, length(titolo)";
		$q = mysqli_query(connect(), $k) or die("errore ".$k);
		while($v = $q->fetch_array())
		{?>
			<option value="<?echo $v[0];?>" class="<?echo $v[1];?>"><?echo $v[0];?></option><?
		}?>
		</select>
		<button id="moduleClassInsert" class="actionInsert">Associa</button>
		<ul id="moduleClassList"><?
			$k = "select idC,idP from RequirementClass where idR = '$id'";
			$q = mysqli_query(connect(), $k) or die("errore reperimento prorpie ".$k);
			while($v = $q->fetch_array())
			{?>
				<li>
					<button class="actionDelete moduleClassDelete">ELIMINA</button>
					<span class="<?echo $v[1];?>"><?echo $v[0];?></span>
				</li><?
			}?>
		</ul>
	</div><?
}
?>