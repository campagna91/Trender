<? require_once '__system.php'; ?>

<!-- Modal windows -->
<div id="verbalsInsertion" class="modal modal-fixed-footer">
	<div class="modal-content">
	  <h4>Insert new requirement</h4>
	  <div class="row">

	  	<!-- Date -->
	  	<div class="input-field col s12">
	  		<input id="date" type="date" format="yyyy-mm-dd" class="datepicker validate">
	  		<label for="date">Date</label>
	  	</div>

	  	<!-- Text -->
	  	<div class="col s12">
	  		<div class="input-field">
	  			<textarea id="text" class="materialize-textarea validate"></textarea>
	  			<label for="text">Text</label>
	  		</div>
			</div>

		</div>
	</div>
	<div class="modal-footer">
		<a id="verbalInsert" class="modal-action waves-effect waves-green btn-flat">Insert</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Back</a>
	</div>
</div>

