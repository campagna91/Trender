<?
	$kValidationTest = "select test, description, implemented, satisfied from ValidationTest where requirement = '$id'";
	$q = mysqli_query(connect(), $kValidationTest) or die("ERRORE: " . $kValidationTest);
	$vValidationTest = $q->fetch_array();
	$kValidationTestStep = "select stepNumber, stepDescription from ValidationTestStep where test = '$vValidationTest[0]'";
	$n = mysqli_num_rows($q);
?>
<div class="row">
	<div class="col blue-grey s10 offset-s1" id="requirementValidationTests">
		<h3>Validation Test</h3>

		<!-- Description -->
		<div class="input-field col s9">
			<textarea id="requirementValidationTestDescription" class="materialize-textarea validate"><? echo $vValidationTest[1] ?></textarea>
			<label for="requirementValidationTestDescription">Test description</label>
		</div>

		<!-- Implemented -->
		<div class="input-field col s4">
			<select id="requirementValidationTestImplemented" class="validate">
				<option value="">Select an option</option>
				<option value="implemented">Implemented</option>
				<option value="notImplemented">Not implemented</option>
			</select>
		</div>

		<!-- Satisfied -->
		<div class="input-field col s4">
			<select id="requirementValidationTestSatisfied" class="validate">
				<option value="">Select an option</option>
				<option value="satisfied">Satisfied</option>
				<option value="notSatisfied">Not satisfied</option>
			</select>
		</div>

		<a id="requirementValidationTestAddStep" class="col s3 offset-s1 btn-large">Add step</a>

		<?
			$q = mysqli_query(connect(), $kValidationTestStep) or die("ERRORE: " . $kValidationTestStep);
			while($v = $q->fetch_array()) {
				echo "<div class='input-field col s10 offset-s1 step'><p> $v[0]°</p><a class='btn red stepDelete'><i class='material-icons'>delete</i></a><input class='col s10' value='$v[1]' type='text'></div>";
			}
			if($n > 0)
				echo "<a id='requirementValidationTestUpdate' class='col s12 btn-large'>Save</a>";
			else 
				echo "<a id='requirementValidationTestInsertion' class='col s12 btn-large'>Save</a>";
		?>
	</div>
</div>

<script>
	selectCurrent('requirementValidationTestImplemented', <? echo json_encode($vValidationTest[2]);	?>);
	selectCurrent('requirementValidationTestSatisfied', <? echo json_encode($vValidationTest[3]);	?>);
</script>