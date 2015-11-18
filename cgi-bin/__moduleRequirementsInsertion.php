<? require_once '__system.php'; ?>

<!-- Modal windows -->
<div id="requirementInsertion" class="modal modal-fixed-footer">
	<div class="modal-content">
	  <h4>Insert new requirement</h4>
	  <div class="row">

	  	<!-- Dad -->
	  	<div class="input-field col s3">
	  		<select id="dad"> 
	  			<option value=''>Select a dad</option>
	  			<? 
	  				$q = mysqli_query(connect(), "select * from Requirements order by substr(requirement, 4, length(requirement))");
		  			while($v = $q->fetch_array()) { ?>
		  				<option value="<?echo $v[0]?>"><?echo $v[0]?></option>
		  			<? }
		  		?>
	  		</select>
	  		<label>Dad</label>
	  	</div>

	  	<!-- Importance -->
	  	<div class="input-field col s3">
				<select id="importance">
					<option value="0">Obligatory</option>
					<option value="1">Desiderable</option>
					<option value="2">Optional</option>
				</select>
				<label>Importance</label>
			</div>
			<!-- Type -->
			<div class="input-field col s3">
				<select id="type">
					<option value="F">Functional</option>
					<option value="P">Performance</option>
					<option value="Q">Qualitative</option>
					<option value="V">Binding</option>
				</select>
				<label>Type</label>
			</div>

			<!-- Source -->
			<div class="input-field col s3">
				<select id="source" class="validate">
					<option value=''>Select a source</option><?
					$q = mysqli_query(connect(), "select * from RequirementSources");
					while($v = $q->fetch_array()) { ?>
						<option value="<?echo $v[0]?>"><?echo $v[0]?></option> <?
					} ?>
				</select>
				<label>Source</label>
			</div>

			<!-- Description -->
			<div class="input-field col s12">
		    <textarea id="description" class="materialize-textarea validate"></textarea>
		    <label for="description">Description</label>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a id="requirementInsert" class="modal-action waves-effect waves-green btn-flat">Insert</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>