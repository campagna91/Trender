<? 
	require_once '__system.php';
	$kPackage = "select package from Packages";
?>
<div id="unitTestsInsertion" class="modal modal-fixed-footer blue-grey">
	<div class="modal-content">
	  <h4>Insert new unit test</h4>
	  <div class="row" id="unitTestInsertion">
	  	
	  	<!-- Package -->
	  	<div class="input-field col s12">
	  		<select id="unitTestInsertionPackage" class="validate">
	  			<option value="">Select a package</option>
	  			<?
	  				$q = mysqli_query(connect(), $kPackage) or die("ERRORE: " . $kPackage);
	  				while($v = $q->fetch_array()) { ?>
	  					<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option>
	  				<? }
	  			?>
	  		</select>
	  		<label>Package</label>
	  	</div>

	  	<!-- Class to combine -->
	  	<div class="input-field col s12">
	  		<select id="unitTestInsertionClasses" class="validate">
	  			<option value="">Select a class</option>
	  		</select>
	  		<label>Class</label>
	  	</div>

	  	<!-- Methods to combine -->
	  	<div class="input-field col s12 validate">
	  		<select id="unitTestInsertionMethods" class="validate">
	  			<option value="">Select a method to combine</option>
	  		</select>
	  		<label>Method to combine</label>
	  	</div>

	  	<a id="unitTestInsertionMethodInsert" class="waves-effect waves-light btn-large center">Add method</a>
		</div>
		<div class="row">

			<!-- Method list -->
			<div class="row" id="unitTestInsertionMethodsList"></div>
		
		</div>

		<div class="row" id="unitTestInsertionContent">
			
			<!-- Description -->
	  	<div class="input-field col s12">
	  		<textarea id="unitTestInsertionDescription" class="materialize-textarea validate"></textarea>
	  		<label for="unitTestInsertionDescription">Description of test</label>
	  	</div>

	  </div>

	</div>
	<div class="modal-footer">
		<a id="unitTestInsert" class="modal-action waves-effect waves-green btn-flat">Insert</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>




