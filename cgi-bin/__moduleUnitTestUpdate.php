<? 
require_once('__system.php');
if(isset($_POST['id']))
{?>
	<div id="moduleUpdate"><?
		$id = $_POST['id'];
		$kT = "select description, relations from UnitTest where idUT = $id";
		$qT = mysqli_query(connect(), $kT) or die("errore selezione descrizione ".$kT);
		$vT = $qT->fetch_array();?>
		<h6 id="moduleUpdateId"><?echo $id;?></h6>
		<textarea id="moduleUpdateDescription"><?echo $vT[0];?></textarea><?
		$k = "select titolo from Classi order by titolo, length(titolo)";
		$q = mysqli_query(connect(), $k) or die("err select classi ".$k);?>
		<select id="moduleUpdateClass"><?
		while($v = $q->fetch_array())
		{?>
			<option value="<?echo $v[0];?>"><?echo $v[0];?></option><?
		}?>
		</select>
		<select id="moduleUpdateMethod">
		</select>
		<button id="moduleUpdateAddRelation" class="actionInsert">Add method</button>
		<ul id="moduleUpdateList"><?
			$i = 0;
			$method = split(";",$vT[1]);
			while($i < count($method)-1)
			{?>
				<li><button class="moduleUpdateRaltionDelete actionDelete">Elimina</button><span><? echo $method[$i]; $i++; ?></span></li><?
			}?>
		</ul>
		<button id="moduleUpdateUpdate" class="actionUpdate">Salva</button>
	</div><?
}