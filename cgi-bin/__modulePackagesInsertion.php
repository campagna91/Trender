<? require_once '__system.php'; ?>

<!-- Modal windows -->
<div id="packagesInsertion" class="modal modal-fixed-footer">
	<div class="modal-content">
	  <h4>Insert new package</h4>
	  <div class="row">

	  	<!-- Dad -->
	  	<div class="input-field col s6">
	  		<select id="dad"> 
	  			<option value="">Select a dad</option>
	  			<? $q = mysqli_query(connect(), "select * from Packages");
	  			while($v = $q->fetch_array()) { ?>
	  				<option value="<?echo $v[0]?>"><?echo $v[0]?></option> <?
	  			}?>
	  		</select>
	  		<label>Dad</label>
	  	</div>

	  	<!-- Package -->
	  	<div class="input-field col s6">
				<input type="text" id="package" class="validate">
				<label for="package">Package</label>
			</div>
		</div>
		<div class="row">

			<!-- Description -->
			<div class="input-field col s12">
				<textarea class="materialize-textarea validate" id="description"></textarea>
				<label for="description">Description</label>
			</div>
		</div>
		<div class="row">

			<!-- Image path -->
			<div class="input-field col s6">
				<textarea class="materialize-textarea" id="imagePath"></textarea>
				<label for="imagePath">Image Path</label>
			</div>

			<!-- Didascalia -->
			<div class="input-field col s6">
				<textarea class="materialize-textarea" id="didascalia"></textarea>
				<label for="didascalia">Didascalia</label>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a id="packageInsert" class="modal-action waves-effect waves-green btn-flat">Insert</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>