<?

	// System utilities
	require_once '__system.php';
	$data = $_POST['data'];
	
	$kMethodParams = "select param, paramType, description from ClassMethodsParams where class = '$data[0]' and package = '$data[1]' and signature = '$data[2]' and returnType = '$data[3]'";
	$q = mysqli_query(connect(), "select type from Types");
	$types = [];
	while($v = $q->fetch_array()) {
		array_push($types, $v[0]);
	}

	// Retrieve method information
	$kMethod = " select description from ClassMethods where class = '$data[0]' and package = '$data[1]' and signature = '$data[2]' and returnType = '$data[3]'";
	$q = mysqli_query(connect(), $kMethod) or die("ERRORE: " . $kMethod);
	$v = $q->fetch_array();
?>
<div id="classesMethodsUpdate" class="modal modal-fixed-footer blue-grey">
	<div class="modal-content">
		<h3>Update method</h3>
		<h6 id="updateMethod"><? echo $data[3] . "." . $data[2] ?></h6>

		<!-- Method update -->
		<div class="row" id="classMethodsUpdate">

			<!-- Type -->
			<div class="input-field col s6">
				<select id="classMethodsUpdateType" class="validate">
					<option value="">Select a type</option>
					<?
						foreach($types as $t ) { ?>
							<option value="<? echo $t ?>"><? echo $t ?></option>
						}
						<? }
					?>
				</select>
				<label>Type</label>
			</div>

			<!-- Signature -->
		  <div class="input-field col s6">
		    <input id="classMethodsUpdateSignature" type="text" class="validate" value="<? echo $data[2] ?>">
		    <label class="active" for="methodSignature">Signature</label>
		  </div>

		  <!-- Description -->
		  <div class="input-field col s12">
		  	<textarea id="classMethodsUpdateDescription" class="materialize-textarea validate"><? echo $v[0] ?></textarea>
		  	<label for="methodDescription">Description</label>
		  </div>

		</div>
		<div class="row" id="classMethodUpdateParamInsert">
		  
	  	<!-- Param insert -->
	  	<h5>Insert new param</h5>

	  	<!-- Type -->
	  	<div class="input-field col s6">
	  		<select id="classMethodUpdateParamType" class="validate">
	  			<option value=''>Select a type</option>
		  		<?
		  			foreach($types as $v) { ?>
		  				<option value="<? echo $v ?>"><? echo $v ?></option>
		  			<? }
		  		?>
	  		</select>
	  		<label>Param type</label>
	  	</div>

	  	<!-- Name -->
	  	<div class="input-field col s6">
	  		<input type="text" class="validate" id="classMethodUpdateParamName">
	  		<label>Param name</label>
	  	</div>

			<!-- Description -->
	  	<div class="input-field col s12">
	  		<input type="text" class="materialize-textarea validate" id="classMethodUpdateParamDescription">
	  		<label>Param description</label>
	  	</div>

	  </div>
	  <a id="classMethodUpdateParamInsert" class="waves-effect waves-light btn-large">ADD PARAM</a>
	 	<div class="row">
			  
		  <!-- Params list -->
		  <div class="col s12" id="classMethodsUpdateParamsList">
		  	<?
		  		$q = mysqli_query(connect(), $kMethodParams) or die("ERRORE: " . $kMethodParams);
		  		while($v = $q->fetch_array()) { ?>
						<div class='chip'>
							<a class='tooltipped' data-position='bottom' data-delay='50' data-tooltip="<? echo $v[2] ?>"><? echo $v[1] . ":" . $v[0] ?></a>
							<i class='material-icons paramDelete'>close</i>
						</div>
		  		<? }
		  	?>
		  </div>

		</div>
	</div>
	<div class="modal-footer">
		<a id="classMethodUpdate" class="modal-action waves-effect waves-green btn-flat">Update</a>
	  <a class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
	</div>
</div>

<script>
	selectCurrent('classMethodsUpdateType', $("#updateMethod").text().split(".")[0]);
</script>
