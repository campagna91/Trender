<?
require_once('__system.php');?>
	<table>
		<tr>
			<th></th>
			<th>CASO</th>
			<th>PADRE</th>
			<th>TITOLO</th>
			<th>DESCRIZIONE</th>
			<th>PRECONDIZIONE</th>
			<th>POSTCONDIZIONE</th>
			<th></th>
		</tr><?
		function modListRecursive($child = 0, $id = 'none')
		{
			if(!$child) $k = "select * from CasiUso where padre is NULL ORDER BY length(idUC),idUC";
			else $k = "select * from CasiUso where padre = '$id' order by length(idUC),idUC";
			$q = mysqli_query(connect(),$k)or die("STAMPACASO: (0) Err stampa ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[0];?>">
					<td class="typeCommand">
						<button class="mainListDelete actionDelete">-</button>
						<button class="mainListChoose actionChoose">+</button>
					</td>
					<td><?echo stampaAnnidamento($v[0]);?></td>
					<td><?echo stampaAnnidamento($v[1]);?></td>
					<td><?echo $v[2];?></td>
					<td><?echo $v[3];?></td>
					<td><?echo $v[7];?></td>
					<td><?echo $v[8];?></td>
					<td><?
						if($v[4] || $v[5])
						{?> 
							<button class="switch <?if($v[4]) echo 'typeExtension'; if($v[5]) echo 'typeInclusion';?>"><?if($v[4]) echo 'ESTENSIONE'; else echo'INCLUSIONE';?></button><?
						}
						if($v[6]) 
						{?>
							<button class="switch typeHeir">EREDE</button><?
						}?>
					</td>
				</tr><?
				modListRecursive(1,$v[0]);	
			}

		} 
		modListRecursive();
		?>
	</table>