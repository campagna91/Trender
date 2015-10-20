<? 
	$kRelations = "select classEnd, packageEnd, relation from ClassRelations where classStart = '$id' and packageStart = '$package'";
	$kRelationsSelect = "select class, package from Classes where class <> '$id'";
?>
<div class="col s4 offset-s1 blue-grey" id="classesRelations">
	<h3>Relations</h3>

	<!-- Class related -->
	<div class="input-field col s12">
		<select id="related" class="validate">
			<option value="">Select a class</option>
			<?
				$q = mysqli_query(connect(), $kRelationsSelect) or die("err ".$kRelationsSelect);
				while($v = $q->fetch_array()) { ?>
					<option value="<? echo $v[1] . "." . $v[0] ?>"><? echo $v[1] . "." . $v[0] ?></option>
				<? }
			?>
		</select>
		<label>Class</label>
	</div>

	<!-- Type -->
	<div class="input-field col s12">
		<select id="type" class="validate">
			<option value="navigable">Navigable</option>
			<option value="aggregation">Aggregation</option>
			<option value="composition">Composition</option>
			<option value="dependency">Dependency</option>
			<option value="relization">Relization</option>
			<option value="association">Association</option>
		</select>
		<label>Relation's Type</label>
	</div>

	<div id="classRelationList" class="col s12">
		<a id="classRelationInsert" class="waves-effect waves-light btn-large">Relates</a>
		<?
			$q = mysqli_query(connect(), $kRelations) or die("ERRORE: " . $kRelations);
			while($v = $q->fetch_array()) { ?>
				<div class="chip">
				 	<a href="classes.php?id=<? echo $v[0] ?>&package=<? echo $v[1] ?>"><? echo strtoupper(substr($v[2], 0, 3)) . ". " . $v[1] . '.' . $v[0] ?></a>
				 	<i class="material-icons classRelationDelete">close</i>
			 	</div>
			<? }
		?>
	</div>
</div>