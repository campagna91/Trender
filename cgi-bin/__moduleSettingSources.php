<h3>Sources</h3>
<p>Here you are able to insert different source of requirements.</p>

<div class="row" id="settingsSourcesInsertion">
	
	<!-- Sources name -->
	<div class="input-field col s8">
	  <input placeholder="Placeholder" id="settingSourceName" type="text" class="validate">
	  <label for="settingSourceName">Type name</label>
	</div>

	<a id="settingSuorceInsertion" class="col s3 offset-s1 waves-effect waves-light btn-large">Add</a>
</div>

<p>List of actual sources</p>
<div class="col 12" id="settingSourceList">
	<?
		$k = "select * from RequirementSources";
		$q = mysqli_query(connect(), $k)or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) { ?>
			<div class="chip"><a><? echo $v[0] ?></a><i class="material-icons sourceDelete">close</i></div>
		<? }
	?>
</div>