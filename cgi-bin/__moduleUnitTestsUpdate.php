<?
	$kUpdate = "select * from UnitTests where test = '$id'";
	$kMethod = "select * from UnitTestClassesMethods where test = '$id'";
	$q = mysqli_query(connect(), $kUpdate) or die("ERRORE : " . $kUpdate);
	$v = $q->fetch_array();
?>
<div class="row">
	<div id="unitTestsUpdate" class="col s10 offset-s1 blue-grey">
		<h3>Update</h3>

		<!-- Description -->
		<div class="input-field col s12">
			<textarea id="unitTestDescription" class="materialize-textarea validate"><? echo $v[1] ?></textarea>
			<label for="unitTestDescription">Description</label>
		</div>
		
	<a id="unitTestUpdate" class="waves-effect waves-light btn-large">SAVE</a>
	</div>

</div>