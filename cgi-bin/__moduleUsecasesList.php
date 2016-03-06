<? require_once '__system.php'; ?>
<div class="col s10 offset-s1" id="mainList">
	<table class="striped">
		<thead>
			<tr>
				<th>Usecase</th>
				<th>Title</th>
				<th>Description</th>
			</tr>
		</thead>
		<tbody> <?
		function modListRecursive($child = 0, $id = 'none')
		{
			if(!$child) $k = "select * from Usecases where dad is NULL ORDER BY length(usecase),usecase";
			else $k = "select * from Usecases where dad = '$id' order by length(usecase),usecase";
			$q = mysqli_query(connect(),$k)or die("MODLISTRECURSIVE: ".$k);
			while($v = $q->fetch_array())
			{?>
				<tr class="<?echo $v[0];?>">
					<td class="target"><a href="usecases.php?id=<?echo $v[0];?>"><?echo $v[0];?></a></td>
					<td><?echo $v[2];?></a></td>
					<td><?echo $v[3];?></td>
				</tr><?
				modListRecursive(1, $v[0]);
			}
		}
		modListRecursive(); ?>
		</tbody>
	</table>
</div>

<script>
	truncate('mainList');
	truncate('mainList');
	truncate('mainList');
</script>
