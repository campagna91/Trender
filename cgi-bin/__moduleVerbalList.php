<?
require_once('__system.php');?>
	<table>
		<tr>
			<th></th>
			<th>DATA</th>
			<th>STESURA</th>
		</tr><?
		$k = "select * from Verbali";
		$q = mysqli_query(connect(),$k) or die("MODLIST : (verbali) ".$k);
		while($v = $q->fetch_array())
		{ $i = 0; 
			?>
			<tr class="<?echo $v[0];?>">
				<td class="typeCommand"><button class="mainListDelete actionDelete">-</button></td>
				<td><?echo $v[0];?></a></td>
				<td><?if(strlen($v[1])>100) echo substr($v[1],0,100); else echo $v[1];?></td>
			</tr><?
		}
		?>
	</table>