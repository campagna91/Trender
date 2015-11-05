<div id="classesAttributesUpdate" class="modal modal-fixed-footer">
	<div class="modal-content">
		<h3>Update attribute</h3>
		<h6 id="updateAttribute"></h6>

		<div class="row">

			<!-- Type -->
			<div class="input-field col s12">
				<select id="updateAttributeType" class="validate">
					<option value="">Select a type</option>
					<?
						foreach($types as $v) { ?>
							<option value="<? echo $v ?>"><? echo $v ?></option>
						<? }
					?>
				</select>
				<label>Type</label>
			</div>

			<!-- Name -->
		  <div class="input-field col s12">
		    <input id="updateAttributeName" type="text" class="validate">
		    <label class="active" for="updateAttributeName">Attribute name</label>
		  </div>

		  <!-- Description -->
		  <div class="input-field col s12">
		  	<textarea id="updateAttributeDescription" onready="alert('ciao');" class="materialize-textarea validate"></textarea>
		  	<label for="updateAttributeDescription">Description</label>
		  </div>
		 </div>

	</div>
	<div class="modal-footer">
		<a id="classAttributeUpdate" class="modal-action waves-effect waves-green btn-flat">Save</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>