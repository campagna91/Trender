<?
	$kMethod = "select signature, returnType, description from ClassMethods where class = '$id' and package = '$package'";
?>
<div class="row blue-grey">
	
	<div class="row" id="classesMethodInsert">
		<h3>Methods</h3>

		<!-- Type -->
		<div class="input-field col s6">
			<select id="methodType" class="validate">
				<option value="">Select a type</option>
				<?
					foreach($types as $v) { ?>
						<option value="<? echo $v ?>"><? echo $v ?></option>
					<? }
				?>
			</select>
			<label>Return type</label>
		</div>

		<!-- Signature -->
	  <div class="input-field col s6">
	    <input value="" id="methodSignature" type="text" class="validate">
	    <label class="active" for="methodSignature">Signature</label>
	  </div>

	  <!-- Description -->
	  <div class="input-field col s12">
	  	<textarea id="methodDescription" class="materialize-textarea validate"></textarea>
	  	<label for="methodDescription">Description</label>
	  </div>

	</div>

	<!-- Params property -->
	<div class="row blue-grey darken-1" id="classMethodParam">

		<div class="col s7">
		
			<!-- Type -->
		  <div class="input-field col s12">
		  	<select id="paramType" class="validate">
		  		<option value="">Select a type</option>
		  		<?
						foreach($types as $v) { ?>
							<option value="<? echo $v ?>"><? echo $v ?></option>
						<? }
					?>
		  	</select>
		  	<label>Param's type</label>
		  </div>

			<!-- Name -->
		  <div class="input-field col s12">
		    <input value="" id="paramName" type="text" class="validate">
		    <label class="active" for="paramName">Name</label>
		  </div>

		  <!-- Description -->
		  <div class="input-field col s12">
		  	<textarea class="materialize-textarea validate tooltipped" data-position="bottom" data-delay="50" data-tooltip="I am tooltip" id="paramDescription"></textarea>
		  	<label for="paramDescription">Param's description</label>
		  </div>

		  <a id="classMethodParamInsert" class="waves-effect waves-light btn-large">ADD PARAM</a>
  	</div>

  	<!-- Param list -->
  	<div class="col s5" id="classMethodParamList"></div>

	</div>

	<a id="classMethodInsert" class="waves-effect waves-light btn-large">INSERT</a>
	<div class="row" id="classMethodList">
		<table class="striped">
			<?
				$q = mysqli_query(connect(), $kMethod) or die("ERRORE: " . $kMethod);
				while($v = $q->fetch_array()) { ?>
					<tr class="<? echo $v[1] . "." . $v[0] ?>">
						<td><? echo $v[0] ?></td>
						<td><? echo $v[1] ?></td>
						<td><? echo $v[2] ?></td>
					</tr>
				<? }
			?>
		</table>
	</div>
</div>