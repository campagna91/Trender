<?
require_once('__system.php');
$id = $_POST['id'];
$kSystem = "select * from RequirementTest where '$id' = object and type = 'system'";
$qSystem = mysqli_query(connect(),$kSystem) or die("err validation");
$r = mysqli_num_rows($qSystem);
$v = $qSystem->fetch_array();?>
<tr id="moduleTestSystem" class="<?if($r > 0) echo $v[1]; else echo 'new';?>">
	<td colspan="6" class="typeTest">
		<h6 id="moduleTestId"><?echo $id;?></h6>
		<label>Descrizione del requisito di sistema</label> 
		<textarea id="moduleTestSystemDescription"><?if($r > 0)echo $v[2];?></textarea>
		<button id="moduleTestSystemSwitchImplemetedNotImplemented" class="switch <?
			if($r > 0)
			{ 
				if($v[3]) echo 'typeSatisfied'; 
				else echo 'typeNotSatisfied'; 
			} else echo 'typeNotSatisfied';?>"
			value = "<?
				if($r > 0){
					if($v[3]) echo 'satisfied';
					else echo 'notSatisfied';
				} else echo 'notSatisfied';?>"><?
			if($r > 0)
			{ 
				if($v[3]) echo "IMPLEMENTATO"; 
				else echo "NON IMPLEMENTATO";
			} else echo "NON IMPLEMENTATO";?>
		</button>
		<button id="moduleTestSystemInsert" class="<?
			if($r) echo 'actionUpdate'; 
			else echo 'actionInsert';?>"><?
				if($r > 0) echo "Salva"; 
				else echo "Inserisci";?>
		</button>
	</td>
	<hr>
</tr><?
$kValidation = "select * from RequirementTest where object = '$id' and type = 'validation'";
$qValidation = mysqli_query(connect(),$kValidation) or die("err valiatin");
$r = mysqli_num_rows($qValidation);
$v = $qValidation->fetch_array();?>
<tr id="moduleTestValidation" class="<?
	if($r) echo $v[1]; 
	else echo 'new';?>">
	<td colspan="3" class="typeTest">
		<label id="moduleTestValidationLabelDescription">Descrizione del test di validazione</label>
		<textarea id="moduleTestValidationDescription" class="typeValidation"><?if($r > 0){$data = explode('\\begin{enumerate}',$v[2]); echo $data[0];}?></textarea>
	</td>
	<td colspan="3" class="typeTest">
		<label id="moduleTestValidationLabelFit">Passi del test</label><?
		if($r > 0){
			$data = explode('\\begin{enumerate}',$v[2]);
			$description = $data[0];
			$fitsList = $data[1];
			if(count($fitsList) >= 1)
			{
				$fits = explode('\\item ',$fitsList);
				for($i = 1; $i <= count($fits)-1; $i++)
				{?>
					<textarea class="moduleTestValidationFit"><?if($i == count($fits)-1) echo trim(explode('\\end{enumerate}',$fits[$i])[0]);else echo trim($fits[$i]);?></textarea>
					<button class='moduleTestAddFit actionInsert'>+</button>
					<button class='moduleTestDeleteFit actionDelete'>-</button><?
				}?>
				<textarea class="moduleTestValidationFit"></textarea>				
				<button class="moduleTestAddFit actionInsert">+</button>
				<button class='moduleTestDeleteFit actionDelete'>-</button><?
			} else {	?>
				<textarea class="moduleTestValidationFit"></textarea>				
				<button class="moduleTestAddFit actionInsert">+</button>
				<button class='moduleTestDeleteFit actionDelete'>-</button><?
			}
		} else {	?>
			<textarea class="moduleTestValidationFit"></textarea>				
			<button class="moduleTestAddFit actionInsert">+</button>
			<button class='moduleTestDeleteFit actionDelete'>-</button><?
		}?>
		<button id="moduleTestValidationInsert" class="<?
			if($r > 0) echo 'actionUpdate'; 
			else echo 'actionInsert';?>"><?
			if($r) echo'Salva';
			else echo'Inserisci';?>
		</button>
	</td>
</tr>