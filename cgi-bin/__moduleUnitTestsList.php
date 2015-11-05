<? require_once '__system.php'; ?>

<div class="col s10 offset-s1" id="mainList">
	<table class="striped">
		<thead>
			<tr>
				<th>Test</th>	
				<th>Description</th>
				<th>Methods</th>
			</tr>
		</thead>
		<tbody> 
			<?
				$k = "select test, description from UnitTests order by test";
				$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
				while($v = $q->fetch_array()) { 
					$qMethods = mysqli_query(connect(), "select returnType, package, class, signature from UnitTestClassesMethods where test = '$v[0]'"); ?>
					<tr class="<? echo $v[0] ?>">
						<td><? echo $v[0] ?></td>
						<td><? echo $v[1] ?></td>
						<td>
							<ul class="collection">
								<?
									while($vMethods = $qMethods->fetch_array()) { ?>
		      					<li class="collection-item"><? echo $vMethods[0] . " " . $vMethods[1] . ":" . $vMethods[2] . "." . $vMethods[3] ?></li>
									<? }
								?>
							</ul>
						</td>
					</tr> 
				<? } 
			?>
		</tbody>
	</table>
</div>

