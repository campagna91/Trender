<? 
require_once('__system.php');
?>
	<div id="moduleInteraction">
		<select id="moduleInteractionClass"><?
			$k = "select * from Classi where titolo != '$id' and titolo not in (select classB from ClassInteractions where classA = '$id' ) order by length(titolo),titolo";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE : (detailsClassInteractions)".$k);
			while($v = $q->fetch_array())
			{?>
				<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
			}?>
		</select>
		<button id="moduleInteractionInsert" class="actionInsert">Aggiungi interazione</button>
		<label>Descrizione</label>
		<textarea id="moduleInteractionDescription"></textarea>
		<table><?
			$k = "select classB,interazione from ClassInteractions where classA = '$id'";
			$q = mysqli_query(connect(),$k) or die("MODUPDATE: (detailsClassInteractions)".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[0];?>">
					<td><button class="moduleInteractionDelete actionDelete">-</button></td>
					<td><? echo $v[0];?></td>
					<td><textarea class="moduleInteractionDescription"><? echo $v[1];?></textarea></td>
					<td><button class="moduleInteractionUpdate actionUpdate">Salva</button></td>
				</tr><?
			}?>
		</table>
	</div>
