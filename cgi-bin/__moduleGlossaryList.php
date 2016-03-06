<?
require_once '__system.php'; ?>
<div class="col s10 offset-s1" id="mainList">
	<table class="striped">
		<thead>
			<tr>
				<th>Term</th>
				<th>Explaination</th>
			</tr>
		</thead>
		<tbody>
		<?
			$q = mysqli_query(connect(), "select * from Glossary")or die("err list");
			while($v = $q->fetch_array()) { ?>
				<tr class="<? echo $v[0] ?>">
					<td class="target"><? echo $v[0] ?></td>
					<td><? echo $v[1] ?></td>
				</tr>
			<? } ?>
		</tbody>
	</table>
</div>

<script>
setTimeout(function() { truncate("mainList");}, 1500);
</script>

