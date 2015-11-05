<?
	$kDerivative = "select derivative from ActorsInheritance where base = '$id' order by length(derivative)";
	$q = mysqli_query(connect(),$kDerivative) or die("ERROR: ".$kDerivative); 
?>
<div class="col s4 blue-grey" id="actorDerivative">
	<h3>Derivative</h3>
	<table class="striped"> 
		<?
			while($v = $q->fetch_array())	{ ?>
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s3 actorsDerivativeDelete"><i class="material-icons">delete</i></a>
						<a class="col s7" href="actors.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a>
					</td>
				</tr>
			<? } 
		?>
	</table>
</div>