<? 
	require_once('__system.php');
	$id = $_GET['id']; 

	// Define all actors 
	$all = [];
	$qA = mysqli_query(connect(), "select * from Actors");
	while($v = $qA->fetch_array()) 
		array_push($all, $v[0]);
	
	// Define all kindren
	$common = [$id];
	function child($actor, &$kin) {
		$k = "select derivative from ActorsInheritance where base = '$actor'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) {
			array_push($kin, $v[0]);
			child($v[0], $kin);
		}
	}
	child($id, $common);
	$kindren = array_diff($all, $common); 

	$kUpdate = "select * from Actors where actor = '$id'";
	$q = mysqli_query(connect(), $kUpdate) or die("ERRORE: " . $kUpdate);
	$v = $q->fetch_array();

	$kUpdateSelect = mysqli_query(connect(), "select base from ActorsInheritance where derivative = '$id'");
	$base = $kUpdateSelect->fetch_array();
?>

<div class="row blue-grey">
	<h3>Update</h3>

	<!-- Base -->
	<div class="input-field col s12">
		<select id="actorBase">
			<option value="">Select a base actor</option>
			<?
				foreach($kindren as $a) { ?>
					<option value="<? echo $a ?>"><? echo $a ?></option> 
				<? } 
			?>
		</select>
		<label>Base actor</label>
	</div>

	<!-- Actor -->
	<div class="input-field col s6">
		<textarea id="actorName" class="materialize-textarea validate"><? echo $v[0] ?></textarea>
		<label for="actorName">Actor</label>
	</div>

	<!-- Note -->
	<div class="input-field col s6">
		<textarea id="actorNote" class="materialize-textarea"><? echo $v[1] ?></textarea>
		<label for="actorNote">Note</label>
	</div>

	<a id="actorUpdate" class="waves-effect waves-light btn-large">Save</a>
</div>

<script>
	selectCurrent('actorBase', <? echo json_encode($base[0]);	?>);
</script>