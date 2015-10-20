<?
require_once '__system.php'; ?>
<div class="col s10 offset-s1" id="mainList">
	<table class="striped">
		<thead>
			<tr>
				<th>Class</th>
				<th>Package</th>
				<th>Description</th>
				<th>Use</th>
			</tr>
		</thead>
		<tbody>
		<?
			$q = mysqli_query(connect(), "select * from Classes")or die("err list");
			while($v = $q->fetch_array()) { ?>
				<tr class="<? echo $v[0]." ".$v[3] ?>">
					<td><? echo $v[0] ?></td>
					<td><? echo $v[3] ?></td>
					<td><? echo $v[1] ?></td>
					<td><? echo $v[2] ?></td>
				</tr>
			<? } ?>
		</tbody>
	</table>
</div>

