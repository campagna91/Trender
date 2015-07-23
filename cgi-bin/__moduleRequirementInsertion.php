<?
require_once('__system.php');?>
<div id="moduleInsertion">	
	<label>Padre</label>
	<select id="moduleInsertionDad">	
		<option value="Nessuno">Nessuno</option><?
		$k = "select idR from Requisiti order by length(idR),idR";
		$q = mysqli_query(connect(),$k) or die("INSERTION : (requisiti) ".$k);
		while($v = $q->fetch_array())
		{?>
			<option value="<?echo $v[0];?>"><?echo stampaAnnidamento($v[0]);?></option><?
		}?>
	</select>
	<label>Importanza e Tipo</label>
	<select id="moduleInsertionImportance">
		<option value="0">Obbligatorio</option>
		<option value="2">Desiderabile</option>
		<option value="1">Opzionale</option>
	</select>
	<select id="moduleInsertionType">
		<option>F</option>
		<option>P</option>
		<option>Q</option>
		<option>V</option>
	</select>
	<label>Descrizione</label>
	<textarea id="moduleInsertionDescription"></textarea>
	<button id="moduleInsertionSwitchInsideOutsideChapter" class="switch typeInside" value="inside">INTERNO</button>
	<button id="moduleInsertionInsert" class="actionInsert">Inserisci</button>
</div>
