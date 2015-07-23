<?
require_once('__system.php');?>
<table>
	<tr>
		<th></th>
		<th>REQUISITO</th>
		<th>PADRE</th>
		<th>DESCRIZIONE</th>
		<th>VERBALE</th>
		<th></th>
	</tr><?
	function modListRecursive($child = 0, $id = 'none')
	{
		if(!$child) $k = "select * from Requisiti where padre is NULL ORDER BY substring(idR,2,1),substring(idR,3,1),length(idR),idR";
		else $k = "select * from Requisiti where padre = '$id' order by length(idR),idR";
		$q = mysqli_query(connect(),$k) or die("MODLISTRECURSIVE : (requirement) ".$k);
		while($v = $q->fetch_array())
		{?>
			<tr class="<?echo $v[0];?>">
				<td class="typeCommand">
					<button class="mainListDelete actionDelete">-</button>
					<button class="mainListChoose actionChoose">+</button>
					<button class="mainListTest actionTest">T</button>
				</td>
				<td><?echo stampaAnnidamento($v[0]);?></a></td>
				<td><?echo stampaAnnidamento($v[1]);?></a></td>
				<td><?echo $v[2];?></a></td>
				<td><?echo $v[4];?></a></td>
				<td>
					<button class="switch <?
						if($v[5]) echo 'typeInside'; 
						else if($v[3]) echo 'typeChapter'; 
						else echo 'typeOutside';?>" value="<?if($v[5]) echo 'inside'; else if($v[3]) echo 'chapter'; else echo 'outside';?>"><?if($v[5]) echo 'INTERNO'; else if($v[3]) echo 'CAPITOLATO'; else echo 'ESTERNO';?></button>
					<button class="switch <?if($v[6]) echo 'typeSatisfied'; else echo 'typeNotsatisfied';?>"><?if($v[6]) echo 'SODDISFATTO'; else echo 'NON SODDISFATTO';?></button>
					<button class="<?$t = testIsSet($v[0]); if($t == 0) echo 'testAbsent'; if($t == 1) echo 'testIncomplete'; if($t == 2) echo 'testSetted';?>">T</button><?
					$kC = "select count(idC) from RequirementClass where idR = '$v[0]'";
					$qC = mysqli_query(connect(), $kC) or die("err count relations ");
					$vC = $qC->fetch_array();?>
					<button class="<? if($vC[0]) echo 'actionInsert'; else echo 'actionDelete';?>"><?echo $vC[0]?></button>
				</td>
			</tr><?
			modListRecursive(1,$v[0]);
		}
	}
	modListRecursive();	
	?>
</table>

