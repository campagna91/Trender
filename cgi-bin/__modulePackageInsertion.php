<?
require_once('__system.php');?>
<div id="moduleInsertion">
	<label>Padre</label>
	<select id="moduleInsertionDad">
		<option value="Nessuno">Nessuno</option><?
		$k = "select * from Package order by titolo";
		$q = mysqli_query(connect(),$k) or die("INSERTION : (package)");
		while($v = $q->fetch_array())
		{?>
			<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
		}?>
	</select>
	<label>: : Nome</label>
	<textarea type="text" id="moduleInsertionName"></textarea>
	<label>Path immagine</label>
	<textarea id="moduleInsertionImage"></textarea>
	<label>Descrizione</label>
	<textarea id="moduleInsertionDescription"></textarea>
	<button id="moduleInsertionInsert" class="actionInsert">Inserisci</button>
</div>