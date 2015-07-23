<?
require_once('__system.php');?>
<table>
	<tr>
		<th></th>
		<th>Title</th>
		<th>Description</th>
		<th>Use</th>
		<th>Package</th>
	</tr><?
	$k = "select * from Classi order by length(idP),idP";
	$q = mysqli_query(connect(),$k) or die("MODLIST : (class)".$k);
	while($v = $q->fetch_array())
	{?>
		<tr class="<?echo $v[0];?>">
			<td class="typeCommand">
				<button class="mainListDelete actionDelete">-</button>
			</td>
			<td><?echo $v[0];?></td>
			<td><?echo $v[1];?></td>
			<td><?echo $v[2];?></td>
			<td><?echo $v[3];?></td>
		</tr><?
	}
	?>
</table>