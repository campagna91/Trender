<? 
require_once('__system.php');?>
<div id="moduleInsertion">
	<label>Package di specifica per</label>
	<select id="moduleInsertionPackage"><?
		$k = "select * from Package order by titolo";
		$q = mysqli_query(connect(),$k) or die("INSERTION (class)");
		while($v = $q->fetch_array())
		{?>
			<option id="<?echo $v[0];?>"><?echo $v[0];?></option><?
		}?>
	</select>
	<label>Nome</label>
	<textarea id="moduleInsertionName"></textarea>
	<label>Descrizione</label>
	<textarea id="moduleInsertionDescription"></textarea>
	<label>Uso</label>
	<textarea id="moduleInsertionUse"></textarea>
	<button id="moduleInsertionInsert" class="actionInsert">Inserisci</button>
</div>