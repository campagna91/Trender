<? 
	require_once('__system.php');
	$id = $_GET['id']; 

	// Define all packages 
	$all = [];
	$qA = mysqli_query(connect(), "select * from Packages");
	while($v = $qA->fetch_array()) 
		array_push($all, $v[0]);
	
	// Define all kindren
	$common = [$id];
	function child($package, &$kin) {
		$k = "select package from Packages where dad = '$package'";
		$q = mysqli_query(connect(), $k);
		while($v = $q->fetch_array()) {
			array_push($kin, $v[0]);
			child($v[0], $kin);
		}
	}
	child($id, $common);
	$all = array_diff($all, $common);
	$kUpdate = "select * from Packages where package = '$id'";
?>
<div class="row blue-grey">
	<h3>Update</h3>
	<? 
		$q = mysqli_query(connect(), $kUpdate) or die("ERROR: ".$kUpdate);
		$v = $q->fetch_array();
	?>
	<div class="row">
		<div class="input-field col s6 offset-s3" id="packagesUpdate">
			<select id="packageDad">
				<option value="">Select a package</option>
				<? 
					foreach($all as $value) { ?>
						<option value="<? echo $value ?>"><? echo $value ?></option>
					<? } 
				?>
			</select>
			<label>Dad</label>
		</div>
	</div>
	<div class="row">

		<!-- Package  -->
		<div class="input-field col s6">
			<textarea id="packageName" class="materialize-textarea validate"><? echo $v[0] ?></textarea>
			<label for="packageName">Package</label>
		</div>

		<!-- Description path -->
		<div class="input-field col s6">
			<textarea id="packageDescription" class="materialize-textarea validate"><? echo $v[2] ?></textarea>
			<label for="packageDescription">Description</label>
		</div>
	</div>
	<div class="row">

		<!-- Image path -->
		<div class="input-field col s6">
			<textarea id="packageImagePath" class="materialize-textarea"><? echo $v[3] ?></textarea>
			<label for="packageImagePath">Image path</label>
		</div>

		<!-- Didascalia -->
		<div class="input-field col s6">
			<textarea id="packageImageDidascalia" class="materialize-textarea"><? echo $v[4] ?></textarea>
			<label for="packageImageDidascalia">Didascalia</label>
		</div>

		<a id="packageUpdate" class="waves-effect waves-light btn-large">Save</a>
	</div>
</div>

<script>
	selectCurrent('packageDad', <? echo json_encode($v[1]);	?>);
</script>