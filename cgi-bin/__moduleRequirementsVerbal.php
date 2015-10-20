<? 
	$kVerbal = "select date from Verbals where date not in ( select verbal from RequirementsVerbal where requirement = '$id' ) "; ?>
	$q = mysqli_query(connect(),$kVerbal) or die("MODCHILD : (requisiti) ".$kVerbal); 
?>
<div class="row blue-grey">
	<h3>Verbals</h3>
	<select id="moduleVerbalName"><?
		$q = mysqli_query(connect(),$k) or die ("MODUPDATE : (requisiti) ".$k);
		while($v = $q->fetch_array())
		{?>
			<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
		}?>
	</select>
	<a id="combineVerbal" class="waves-effect waves-light btn-large">Combine</a>
	<table><?
		$k = "select verbal from RequirementsVerbal where requirement = '$id' ";
		$q = mysqli_query(connect(),$k) or die("MODUPDATE : (requisiti) ".$k);
		while($v = $q->fetch_array())
		{?>
			<tr class="<?echo $v[0];?>">
				<td><button class="moduleVerbalDelete actionDelete">-</button></td>
				<td><?echo $v[0];?></td>
			</tr><?
		}?>
	</table>
</div>