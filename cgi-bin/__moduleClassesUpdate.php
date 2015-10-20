<?	
	$kPackageSelect = "select * from Packages";
	$kUpdate = "select * from Classes where class = '$id'";
	$q = mysqli_query(connect(), $kUpdate) or die("ERRORE: " . $kUpdate);
	$vUpdate = $q->fetch_array();
?>
<div class="row blue-grey" id="classesUpdate">
	<h3>Update</h3>

	<!-- Package -->
	<div class="row">
		<div class="input-field col s6">
			<select id="package" class="validate">
				<option value="">Select a package</option>
				<?
					$q = mysqli_query(connect(), $kPackageSelect) or die("ERROR: " . $kPackageSelect);
					while($v = $q->fetch_array()) { ?>
						<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option>
					<? } 
				?>
			</select>
			<label>Package</label>
		</div>

		<!-- Class -->
		<div class="input-field col s6">
			<textarea id="class" class="materialize-textarea"><? echo $vUpdate[0] ?></textarea>
			<label for="class">Class</label>
		</div>
	</div>

	<div class="row">

		<!-- Description -->
		<div class="input-field col s6">
			<textarea id="description" class="materialize-textarea"><? echo $vUpdate[1] ?></textarea>
			<label for="description">Description</label>
		</div>

		<!-- Usage -->
		<div class="input-field col s6">
			<textarea id="applications" class="materialize-textarea"><? echo $vUpdate[2] ?></textarea>
			<label for="applications">Applications</label>
		</div>

		<a id="classUpdate" class="waves-effect waves-light btn-large">Save</a>
	</div>
</div>

<script>
	selectCurrent('package', <? echo json_encode($vUpdate[3]);	?>);
</script>			