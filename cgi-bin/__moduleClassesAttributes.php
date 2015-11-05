<?
	$kAttribute = "select attribute, type, description from ClassAttributes where class = '$id' and package = '$package'";
	$kTypeSelect = "select type from Types";

	$types = [];
	$q = mysqli_query(connect(), $kTypeSelect) or die("ERRORE: " . $kTypeSelect);
	while($v = $q->fetch_array()) {
		array_push($types, $v[0]);
	}
?>
<div class="row blue-grey">
	<h3>Attributes</h3>
	<div id="classesAttributesInsert" class="col s4 blue-grey">
	<h5 class="center">Insert new attribute</h5>

		<!-- Type -->
		<div class="input-field col s12">
			<select id="attributeType" class="validate">
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
	    <input value="" id="attributeName" type="text" class="validate">
	    <label class="active" for="attributeName">Attribute name</label>
	  </div>

	  <!-- Description -->
	  <div class="input-field col s12">
	  	<textarea id="attributeDescription" class="materialize-textarea validate"></textarea>
	  	<label for="attributeDescription">Description</label>
	  </div>

		<a id="classAttributeInsert" class="waves-effect waves-light btn-large">INSERT</a>
	</div>

	<div class="col s8 blue-grey">
		<table class="striped col s12" id="classAttributeList">
			<thead>
				<th></th>
				<th>Name</th>
				<th>Type</th>
				<th>Description</th>
			</thead>
			<tbody>
				<?
					$q = mysqli_query(connect(), $kAttribute) or die("ERRORE: " . $kAttribute);
					while($v = $q->fetch_array()) { ?>
						<tr class="<? echo $v[0] ?>">
							<td class="control">
								<a class="btn-floating btn-medium waves-light attributeUpdate"><i class="material-icons">create</i></a>
								<a class="btn-floating btn-medium waves-light attributeRemove"><i class="material-icons">remove</i></a>
							</td>
							<td><? echo $v[0] ?></td>
							<td><? echo $v[1] ?></td>
							<td><? echo $v[2] ?></td>
						</tr>
					<? }
				?>
			</tbody>
		</table>
	</div>
</div>