<?
	$kIntegration = "select idTest, description, implemented, satisfied from IntegrationTest where package = '$id'";
	$q = mysqli_query(connect(),$kIntegration) or die("ERRORE: " . $kIntegration);
	$v = $q->fetch_array();
	$r = mysqli_num_rows($q);
?>
<div class="blue-grey col s12" id="packagesIntegration">
	<h3>Integration test</h3>

	<!-- Test description -->
	<div class="input-field col s12">
		<textarea id="packageIntegrationDescription" class="materialize-textarea validate"><? echo $v[1] ?></textarea>
		<label for="packageIntegrationDescription">Descrizione del test</label>
	</div>

	<!-- Implemented -->
	<div class="input-field col s6">
		<select id="packageIntegrationImplemented">
			<option value="implemented">Implemented</option>
			<option value="notImplemented">Not implemented</option>
		</select>
	</div>

	<!-- Satisfied -->
	<div class="input-field col s6">
		<select id="packageIntegrationSatisfied">
			<option value="satisfied">Satisfied</option>
			<option value="notSatisfied">Not satisfied</option>
		</select>
	</div>

	<?
		if($r > 0)
			echo "<a id='packageIntegrationUpdate' class='waves-effect waves-light btn-large col s12'>Update</a>";
		else 
			echo "<a id='packageIntegrationInsert' class='waves-effect waves-light btn-large col s12'>Insert</a>";
	?>
</div>

<script>
	selectCurrent('packageIntegrationImplemented', <? echo json_encode($v[2]);	?>);
	selectCurrent('packageIntegrationSatisfied', <? echo json_encode($v[3]);	?>);
</script>