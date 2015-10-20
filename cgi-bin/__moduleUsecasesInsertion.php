<? require_once '__system.php'; ?>

<!-- Modal windows -->
<div id="usecasesInsertion" class="modal modal-fixed-footer">
	<div class="modal-content">
	  <h4>Insert new requirement</h4>
	  <div class="row">

	  	<!-- Dad -->
	  	<div class="input-field col s6">
	  		<select id="dad">
	  			<option value="">Select a dad</option>
	  			<? 
		  			$q = mysqli_query(connect(), "select * from Usecases");
		  			while($v = $q->fetch_array()) { ?>
		  				<option value="<? echo $v[0]?>"><? echo $v[0] ?></option> 
		  			<? }
		  		?>
	  		</select>
	  		<label>Dad</label>
	  	</div>

	  	<!-- Type -->
	  	<div class="input-field col s6">
	  		<select id="type"> 
	  			<option value="" selected>Select a type</option>
	  			<option value="inclusion">Inclusion</option>
	  			<option value="extension">Extension</option>
	  			<option value="heir">Heir</option>
	  		</select>
	  		<label>Type</label>
	  	</div>

			<!-- Title -->
			<div class="input-field col s6">
		    <textarea id="title" class="materialize-textarea validate"></textarea>
		    <label for="title">Title</label>
			</div>
			
			<!-- Description -->
			<div class="input-field col s6">
		    <textarea id="description" class="materialize-textarea validate"></textarea>
		    <label for="description">Description</label>
			</div>
			
			<!-- Precondition -->
			<div class="input-field col s6">
		    <textarea id="precondition" class="materialize-textarea validate"></textarea>
		    <label for="precondition">Precondition</label>
			</div>
			
			<!-- Postcondition -->
			<div class="input-field col s6">
		    <textarea id="postcondition" class="materialize-textarea validate"></textarea>
		    <label for="postcondition">Postcondition</label>
			</div>
			
			<!-- Scene -->
			<div class="input-field col s6">
		    <textarea id="scene" class="materialize-textarea"></textarea>
		    <label for="scene">Scene</label>
			</div>
			
			<!-- Alterinative scene -->
			<div class="input-field col s6">
		    <textarea id="alernativeScene" class="materialize-textarea"></textarea>
		    <label for="alternativeScene">Alterinative scene</label>
			</div>
			
			<!-- Image path -->
			<div class="input-field col s6">
		    <textarea id="imagePath" class="materialize-textarea"></textarea>
		    <label for="imagePath">Image path</label>
			</div>
			
			<!-- Didascalia -->
			<div class="input-field col s6">
		    <textarea id="didascalia" class="materialize-textarea"></textarea>
		    <label for="didascalia">Image didascalia</label>
			</div>

		</div>
	</div>
	<div class="modal-footer">
		<a id="usecaseInsert" class="modal-action waves-effect waves-green btn-flat">Insert</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>

