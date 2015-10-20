<? require_once '__system.php'; 
	$k = "select * from Verbals";
	$q = mysqli_query(connect(), $k) or die("VERBALS: ".$k); ?>
	<div class="col s10 offset-s1" id="mainList">
		<table class="striped">
			<thead>
				<tr>
					<th>Date</th>	
					<th>Text</th>
				</tr>
			</thead>
			<tbody> <?
			while($v = $q->fetch_array()) { ?>
				<tr class="<? echo $v[0]; ?>">
					<td><?echo $v[0];?></td>
					<td><?echo $v[1];?></td>
				</tr> <?
			} ?>
			</tbody>
		</table>
	</div>

