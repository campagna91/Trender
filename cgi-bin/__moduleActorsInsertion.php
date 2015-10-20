<? require_once '__system.php'; ?>

<!-- Modal windows -->
<div id="actorsInsertion" class="modal modal-fixed-footer">
	<div class="modal-content">
	  <h4>Insert new actor</h4>
	  <div class="row">

	  	<!-- Dad -->
	  	<div class="input-field col s6">
	  		<textarea id="actorName" class="materialize-textarea validate"></textarea>
	  		<label for="actorName">Actor</label>
	  	</div>

	  	<!-- Note -->
	  	<div class="input-field col s6">
	  		<textarea id="actorNote" class="materialize-textarea"></textarea>
	  		<label for="actorNote">Note</label>
	  	</div>
		</div>

		<!-- Base actor -->
		<div class="row">
			<div class="input-field col s12">
				<select id="actorBase">
					<option value="">Select a base actor</option> 
					<?
						$q = mysqli_query(connect(), "select actor from Actors") or die("ERROR");
						while($v = $q->fetch_array()) { ?>
							<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option> 
						<? } 
					?>
				</select>
				<label>Base actor</label>
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<a id="actorInsert" class="modal-action waves-effect waves-green btn-flat">Insert</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>