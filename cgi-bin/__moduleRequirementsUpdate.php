<?
	// System utilities
	require_once('__system.php');

	$id = $_GET['id'];
	$kUpdate = "select * from Requirements where requirement = '$id'";
	$q = mysqli_query(connect(),$kUpdate) or die("MODUPDATE: ".$kUpdate); 
	$vUpdate = $q->fetch_array(); 
?>
<div class="row">
	<div class="col s10 offset-s1 blue-grey" id="requirementsUpdate">
		<h3>Update</h3>

		<!-- Description -->
		<div class="row s12">
			<div class="input-field col s12">
	      <textarea id="description" class="materialize-textarea validate"><? echo $vUpdate[2] ?></textarea>
	      <label for="description">Description</label>
	  	</div>
		</div>

		<!-- Importance -->
		<div class="row s12">
			<div class="input-field col s3">
				<select id="importance">
					<option value="0">Obbligatory</option>
					<option value="1">Desiderable</option>
					<option value="2">Optional</option>
				</select>
				<label>Importance</label>
			</div>

			<!-- Type -->
			<div class="input-field col s3">
				<select id="type">
					<option value="F">Functional</option>
					<option value="P">Performance</option>
					<option value="Q">Qualitative</option>
					<option value="V">Binding</option>
				</select>
				<label>Type</label>
			</div>

			<!-- Source -->
			<div class="input-field col s3">
				<select id="source" class="validate">
					<option value=''>Select a source</option> 
					<?
						$q = mysqli_query(connect(), "select * from RequirementSources");
						while($v = $q->fetch_array()) { ?>
							<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option>
						<? }
					?>
				</select>
				<label>Source</label>
			</div>

			<!-- Satisfied -->
			<div class="input-field col s3">
				<select id="satisfied">
					<option value="satisfied">Satisfied</option>
					<option value="notSatisfied">Not satisfied</option>
				</select>
				<label>State</label>
			</div>
			
		</div>
		<a id="requirementUpdate" class="waves-effect waves-light btn-large">Save</a>
	</div>
</div>

<script>
	selectCurrent('source', <? echo(json_encode($vUpdate[3]));	?>); 
	selectCurrent('importance', $("#id").text().substring(1,2) );
	selectCurrent('satisfied', <? echo(json_encode($vUpdate[4]));	?>);
	selectCurrent('type', $("#id").text().substring(2,3) );
</script>