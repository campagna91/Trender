<?
require_once('__system.php');
	function EF($idP) {
		$kEF = "select classA, classB from ClassRelactions where classA in ( select titolo from Classi where idP = '$idP') and classB not in ( select titolo from Classi where idP = '$idP')";
		$qEF = mysqli_query(connect(), $kEF) or die("errore selezine classi esterne al package");
		$numEF = mysqli_num_rows($qEF);
		return $numEF;
	}
	function AF($idP) {
		$kAF = "select classA, classB from ClassRelactions where classA not in (select titolo from Classi where idP = '$idP') and classB in (select titolo from Classi where idP = '$idP')";
		$qAF = mysqli_query(connect(), $kAF) or die("errore selezione classi AF ". $kAF);
		$numAF = mysqli_num_rows($qAF);
		return $numAF;
	}?>
	<table>
		<tr>
			<th></th>
			<th>Title</th>
			<th>Father</th>
			<th>AF</th>
			<th>EF</th>
			<th>INST.</th>
		</tr><?
		function modListRecursive($child = 0,$id = 'none'){
			if(!$child)
				$k = "select titolo,padre,descrizione from Package where padre is NULL order by length(titolo),titolo";
			else 
				$k = "select titolo,padre,descrizione from Package where padre = '$id' order by length(titolo),titolo";
			$q = mysqli_query(connect(),$k)or die("Err");
			$ef = $af = $i = 0;
			while($v = $q->fetch_array())
			{ $ef = EF($v[0]); $af = AF($v[0]); 
				if($ef != 0)
					$inst = $af / ( $ef + $af);
				else $inst = 0;?>
				<tr class="<?echo $v[0];?>">
					<td class="typeCommand">
						<button class="mainListDelete actionDelete">-</button>
						<button class="mainListChoose actionChoose">+</button>
						<button class="mainListTest actionTest">T</button>
					</td>
					<td><?echo $v[0];?></td>
					<td><?echo $v[1];?></td>
					<td><?echo $af;?></td>
					<td><?echo $ef;?></td>
					<td><?echo $inst;?></td>
				</tr><?
				modListRecursive(1,$v[0]);
			}
		}
		modListRecursive();
		?>
	</table>