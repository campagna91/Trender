<? require_once '__system.php'; ?>
<div class="col s10 offset-s1" id="mainList">
	<table class="striped">
		<thead>
			<tr>
				<th>Actor</th>	
				<th>Note</th>
			</tr>
		</thead>
		<tbody> 
		<?
			$k = "select * from Actors order by actor";
			$q = mysqli_query(connect(), $k) or die("ACTORLIST: " . $k);
			while($v = $q->fetch_array()) { ?>
				<tr class="<? echo $v[0] ?>">
					<td><? echo $v[0] ?></td>
					<td><? echo $v[1] ?></td>
				</tr> 
			<? } 
		?>
		</tbody>
	</table>
</div>

