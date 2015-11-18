<?

	// System utilities
	require_once('__system.php');

	$id = $_GET['id'];
	$kUpdate = "select * from Usecases where usecase = '$id'";
	$q = mysqli_query(connect(),$kUpdate) or die("ERROR: ".$kUpdate); 
	$v = $q->fetch_array(); 
?>
<div class="row blue-grey" id="usecasesUpdate">
	<h3>Update</h3>

	<!-- Type -->
	<div class="row" id="<? echo sizeOf(explode(".", $v[0])); ?>">
		<div class="input-field col s4 offset-s4">
			<select id="type" <? if(sizeOf(explode(".", $v[0])) <= 1) echo 'disabled' ?>>
				<option value="">Select a type</option>
  			<option value="inclusion">Inclusion</option>
  			<option value="extension">Extension</option>
  			<option value="heir">Heir</option>
			</select>
			<label>Type</label>
		</div>
	</div> 

	<div class="row">

		<div class="input-field col s3">
			<textarea id="title" class="materialize-textarea validate"><? echo $v[2] ?></textarea>
			<label for="title">Title</label>
		</div>

		<div class="input-field col s3">
			<textarea id="description" class="materialize-textarea validate"><? echo $v[3] ?></textarea>
			<label for="description">Description</label>
		</div>

		<div class="input-field col s3">
			<textarea id="precondition" class="materialize-textarea validate"><? echo $v[5] ?></textarea>
			<label for="precondition">Precondition</label>
		</div>

		<div class="input-field col s3">
			<textarea id="postcondition" class="materialize-textarea validate"><? echo $v[6] ?></textarea>
			<label for="postcondition">Postcondition</label>
		</div>
	</div>

	<div class="row">

		<div class="input-field col s3">
			<textarea id="scene" class="materialize-textarea"><? echo $v[9] ?></textarea>
			<label for="scene">Scene</label>
		</div>

		<div class="input-field col s3">
			<textarea id="alternativeScene" class="materialize-textarea"><? echo $v[10] ?></textarea>
			<label for="alternativeScene">Alternative Scene</label>
		</div>

		<div class="input-field col s3">
			<textarea id="imagePath" class="materialize-textarea"><? echo $v[7] ?></textarea>
			<label for="imagePath">Image path</label>
		</div>
	
		<div class="input-field col s3">
			<textarea id="didascalia" class="materialize-textarea"><? echo $v[8] ?></textarea>
			<label for="didascalia">Didascalia</label>
		</div>

	</div>
	<a id="usecaseUpdate" class="waves-effect waves-light btn-large">Save</a>
</div>

<script>
	selectCurrent('type', <? echo(json_encode($v[4]));	?>); 
</script>