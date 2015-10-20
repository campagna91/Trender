<?	
	$kSubClass = "select derivative, derivativePackage from ClassInheritance where base = '$id'";
?>
<div class="col s3 blue-grey" id="classsesDerivative">
	<h3>Derivatives</h3>

	<div class="input-field col s12 ">
		<table class="striped">
			<?
				$q = mysqli_query(connect(), $kSubClass) or die("err ". $kSubClass);
				while($v = $q->fetch_array()) { ?>
					<div class="chip">
			 			<a href="classes.php?id=<? echo $v[0] ?>&package=<? echo $v[1] ?>"><? echo $v[1] . "." . $v[0] ?></a>
			 		</div>
				<? }
			?>
		</table>
	</div>
</div>
