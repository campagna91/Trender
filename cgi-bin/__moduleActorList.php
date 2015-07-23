<? 
require_once('__system.php');?>
<div id="mainList">
	<table>
		<tr>
			<th></th>
			<th>NOME ATTORE</th>
		</tr><?
		$k = "select idA from Attori order by idA";
		$q = mysqli_query(connect(),$k) or die("MODLIST : (attori) ".$k);
		while($v = $q->fetch_array())
		{?>
			<tr class="<?echo $v[0];?>">
				<td class="typeCommand"><button class="mainListDelete actionDelete">-</button></td>
				<td><?echo $v[0];?></td>
			</tr><?
		}?>
	</table>
</div>