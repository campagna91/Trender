<div id="moduleInsertion">
	<label>Data verbale</label>
	<table>
		<tr>
			<td>gg</td>
			<td>mm</td>
		</tr>
		<tr>
			<td>
				<select id="moduleInsertionDay"><?
					$i = 1; 
					while($i<=31)
					{?>	
						<option value="<?echo $i;?>"><?echo $i;?></option><?
						$i++;
					}?>
				</select> 
			</td>
			<td>
				<select id="moduleInsertionMonth"><?
					$i = 1; 
					while($i<=12)
					{?>
						<option value="<?echo $i;?>" ><?echo $i;?></option><?
						$i++;
					}?>
				</select>
			</td>
		</tr>
	</table>
	<label>Testo verbale</label>
	<textarea id="moduleInsertionText"></textarea>
	<button id="moduleInsertionInsert" class="actionInsert">Inserisci</button>
</div>