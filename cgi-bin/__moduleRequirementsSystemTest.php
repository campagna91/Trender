<?
	$kTestSystem = "select * from SystemTests where '$id' = requirement";
	$q = mysqli_query(connect(), $kTestSystem) or die("ERROR: ".$kTestSystem); 
	$v = $q->fetch_array();
	$r = mysqli_num_rows($q);
?>
<div class="row" id="requirementSystemTest">
	<div class="col blue-grey s10 offset-s1">
		<h3>System test</h3>

		<!-- Description -->
		<div class="input-field col s12">
		  <textarea id="systemTestDescription" class="materialize-textarea validate"><? echo $v[1] ?></textarea>
		  <label for="systemTestDescription">Description</label>
		</div>

		<!-- Satisfied or not -->
		<div class="input-field col s3">
			<select id="systemTestSatisfied">
				<option value="satisfied">Satisfied</option>
				<option value="notSatisfied">Not satisfied</option>
			</select>
			<label>State</label>
		</div>

		<!-- Implemented -->
		<div class="input-field col s3">
			<select id="systemTestImplemented">
				<option value="implemented">Implemented</option>
				<option value="notImplemented">Not implemented</option>
			</select>
			<label>Implementation</label>
		</div>
			<?
				if($r > 0)
					echo "<a id='requirementSystemTestUpdate' class='waves-effect waves-light btn-large col s12'>Update</a>";
				else 
					echo "<a id='requirementSystemTestInsert' class='waves-effect waves-light btn-large col s12'>Insert</a>";
			?>
	</div>
</div>

<!-- Script need to select correct option -->
<script>
	selectCurrent('systemTestSatisfied', <? echo(json_encode($v[3]));	?>); 
	selectCurrent('systemTestImplemented', <? echo(json_encode($v[2]));	?>); 
</script>