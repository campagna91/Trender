<?
	// System utilities
	require_once('__system.php');

	$id = $_GET['id'];
	$kUpdate = "select * from Glossary where term = '$id'";
	$q = mysqli_query(connect(),$kUpdate) or die("MODUPDATE: ".$kUpdate); 
	$vUpdate = $q->fetch_array(); 
?>
<div class="row">
	<div class="col s10 offset-s1 blue-grey" id="requirementsUpdate">
		<h3>Update</h3>

		<!-- Description -->
		<div class="row s12">
			<div class="input-field col s4 offset-s4">
				<input id="name" type="text" class="validate" value="<? echo $vUpdate[0]?>"/>
		      <label for="explanation">Term name</label>
		  	</div>
		</div>

		<!-- Description -->
		<div class="row s12">
			<div class="input-field col s12">
		      <textarea id="explanation" class="materialize-textarea validate"><? echo $vUpdate[1] ?></textarea>
		      <label for="explanation">Term explanation</label>
		  	</div>
		</div>

		<a id="glossaryUpdate" class="waves-effect waves-light btn-large">Save</a>
	</div>
</div>