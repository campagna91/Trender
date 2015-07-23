<?
require_once('__system.php');?>
<div id="moduleInsertion">
	<select id="moduleInsertionDad">	
		<option value="Nessuno">Nessuno</option><?
		$k = "select idUC from CasiUso order by length(idUC),idUC";
	   	$q = mysqli_query(connect(),$k) or die("MODINSERTION : (usecase) ".$k);
		while($v = $q->fetch_array())
		{?>
			<option value="<?echo $v[0];?>"><?echo stampaAnnidamento($v[0]);?></option><?
		}?>
	</select>
	<button id="moduleInsertionSwitchExtensionInclusion" class="switch typeNone" value="none">NESSUNA RELAZIONE</button>
	<button id="moduleInsertionSwitchEredeNonerede" class="switch typeNotHeir" value="notHeir">NON EREDE</button>
	<label>Titolo</label>
	<textarea id="moduleInsertionTitle"></textarea>
	<label>Descrizione</label>
	<textarea id="moduleInsertionDescription"></textarea>
	<label>Precondizione</label>
	<textarea id="moduleInsertionPrecondition"></textarea>
	<label>Postcondizione</label>
	<textarea id="moduleInsertionPostcondition"></textarea>
	<label>Didascalia</label>
	<textarea id="moduleInsertionDidascalia"></textarea>
	<label>Scenario</label>
	<textarea id="moduleInsertionScenario"></textarea>
	<label>Scenario Alternativo</label>
	<textarea id="moduleInsertionAlternativeScenario"></textarea>
	<label>Path immagine</label>
	<textarea id="moduleInsertionPath"></textarea>
	<button id="moduleInsertionInsert" class="actionInsert">Inserisci</button>
</div>