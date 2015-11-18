<h3>Types</h3>
<p>Here you can insert the default type of project language directly in 'Default' package that will not appear in prints.</p>

<div class="row" id="settingsTypesInsertion">
	
	<!-- Types name -->
	<div class="input-field col s8">
	  <input placeholder="Placeholder" id="settingTypesName" type="text" class="validate">
	  <label for="settingTypesName">Type name</label>
	</div>

	<a id="settingTypeInsertion" class="col s3 offset-s1 waves-effect waves-light btn-large">Add</a>
</div>

<p>List of actual sources</p>
<div class="col 12" id="settingTypesList">
	<?
		$k = "select * from Types where package = 'Default'";
		$q = mysqli_query(connect(), $k)or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) { ?>
			<div class="chip"><a><? echo $v[0] ?></a><i class="material-icons typeDelete">close</i></div>
		<? }
	?>
</div>