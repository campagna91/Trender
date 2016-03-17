<? require_once '__system.php'; ?>
<div class="col s10 offset-s1" id="mainList">
	<table class="striped">
		<thead>
			<tr>
				<th>Requirement</th>	
				<th>Dad</th>
				<th>Description</th>
				<th>Source</th>
				<th>Test</th>
			</tr>
		</thead>
		<tbody> 
			<?
				function modListRecursive($child = 0, $id = 'none')
				{
					if(!$child) $k = "select * from Requirements where dad is NULL ORDER BY substring(requirement, 4, length(requirement))";
					else $k = "select * from Requirements where dad = '$id' order by substring(requirement, 4, length(requirement))";
					$q = mysqli_query(connect(),$k) or die("MODLISTRECURSIVE : (requirement) ".$k);
					while($v = $q->fetch_array()) { ?>
						<tr class="<? echo $v[0] ?>">
							<td><a href="requirements.php?id=<? echo $v[0] ?>"><? echo printNesting($v[0]) ?></a></td>
							<td><a href="requirements.php?id=<? echo $v[1] ?>"><? echo $v[1] ?></a></td>
							<td><? echo $v[2] ?></a></td>
							<td><? echo $v[3] ?></td>
							<td>
								<? 
									$c = testIsSet($v[0]);
									if(count(explode(".", $v[0])) > 1) {
										switch($c){
											case(1): echo "<i class=\"material-icons\" style=\"color:green\">thumb_up</i>";										
												break;
											default: echo "<i class=\"material-icons\" style=\"color:red\">report_problem</i>";											
												break;
										}
									} else {
										switch($c){
											case(11): echo "<i class=\"material-icons\" style=\"color:green\">thumb_up</i>";										
												break;
											default: echo "<i class=\"material-icons\" style=\"color:red\">report_problem</i>";									
												break;
										}
									}
								?>
							</td>
						</tr><?
						modListRecursive(1, $v[0]);
					}
				}
				modListRecursive(); 
			?>
		</tbody>
	</table>
</div>

<script>
//truncate('mainList');
</script>