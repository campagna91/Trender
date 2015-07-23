<?
require_once('__system.php');
$id = $_POST['id'];
$kIntegration = "select * from PackageTest where '$id' = object and type = 'integration'";
echo $kIntegration;
$qIntegration = mysqli_query(connect(),$kIntegration) or die("err validation");
$r = mysqli_num_rows($qIntegration);
$v = $qIntegration->fetch_array();?>
<tr id="moduleTestIntegration" class="<?
	if($r > 0) echo $v[1];
	else echo 'new';?>">	
	<td colspan="6" class="typeTest">
		<h6 id="moduleTestId"><?echo $id;?></h6>
		<label>Descrizione del requisito di sistema</label> 
		<textarea id="moduleTestIntegrationDescription"><?if($r > 0) echo $v[2];?></textarea>
		<button id="moduleTestIntegrationSwitchImplemetedNotImplemented" class="switch <?
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
		<button id="moduleTestIntegrationInsert" class="<?
			if($r) echo 'actionUpdate'; 
			else echo 'actionInsert';?>"><?
				if($r > 0) echo "Salva"; 
				else echo "Inserisci";?>
		</button>
	</td>
	<hr>
</tr>