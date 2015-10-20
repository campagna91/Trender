<? require_once '__system.php'; ?>
<div class="col s10 offset-s1" id="mainList">
	<table class="striped">
		<thead>
			<tr>
				<th>Requirement</th>	
				<th>Dad</th>
				<th>Description</th>
				<th>Source</th>
			</tr>
		</thead>
		<tbody> 
			<?
				function modListRecursive($child = 0, $id = 'none')
				{
					if(!$child) $k = "select * from Requirements where dad is NULL ORDER BY substring(requirement, 2, 1), substring(requirement, 3, 1),length(requirement), requirement";
					else $k = "select * from Requirements where dad = '$id' order by length(requirement), requirement";
					$q = mysqli_query(connect(),$k) or die("MODLISTRECURSIVE : (requirement) ".$k);
					while($v = $q->fetch_array())
					{?>
						<tr class="<? echo $v[0] ?>">
							<td><a href="requirements.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a></td>
							<td><a href="requirements.php?id=<? echo $v[1] ?>"><? echo $v[1] ?></a></td>
							<td><? echo $v[2] ?></a></td>
							<td><? echo $v[3] ?></td>
						</tr><?
						modListRecursive(1, $v[0]);
					}
				}
				modListRecursive(); 
			?>
		</tbody>
	</table>
</div>

