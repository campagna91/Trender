<? 
	require_once '__system.php';
	$kBaseClass = "select class from Classes";
?>

<!-- Modal windows -->
<div id="classesInsertion" class="modal modal-fixed-footer">
	<div class="modal-content">
	  <h4>Insert new class</h4>
	  <div class="row">
	  	<div class="row">

	  		<!-- Package -->
		  	<div class="input-field col s6">
		  		<select id="package" class="validate">
		  			<option value="">Select a package</option>
		  			<?
		  				$k = "select * from Packages";
		  				$q = mysqli_query(connect(), $k) or die("err list");
		  				while($v = $q->fetch_array()) { ?>
		  					<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option>
		  				<? } ?>
		  		</select>
		  		<label>Package</label>
		  	</div>
		  
		  	<!-- Class -->
		  	<div class="input-field col s6">
		  		<input type="text" id="class" class="validate">
		  		<label for="class">Class</label>
		  	</div>

	  	</div>
	  	<div class="row">

	  		<!-- Description -->
		  	<div class="col s6">
		  		<div class="input-field">
		  			<textarea id="description" class="materialize-textarea validate"></textarea>
		  			<label for="description">Description</label>
		  		</div>
				</div>
				
				<!-- Use -->
				<div class="col s6">
		  		<div class="input-field">
		  			<textarea id="use" class="materialize-textarea validate"></textarea>
		  			<label for="use">Usage</label>
		  		</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a id="classInsert" class="modal-action waves-effect waves-green btn-flat">Insert</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>




