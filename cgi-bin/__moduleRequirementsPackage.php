<? 
	$kPackageSelect = "select package from Packages where package not in ( select package from PackagesRequirements where requirement = '$id') order by package";
	$kPackage = "select package from PackagesRequirements where requirement = '$id' order by package";
?>
<div class="col s4 offset-s1 blue-grey" id="requirementPackage">
	<h3>Packages</h3>
	<div class="input-field col s12">
		<select id="requirementPackageName" class="validate">
			<option value=''>Select a package</option>
			<?
				$q = mysqli_query(connect(), $kPackageSelect) or die("ERRORE ".$kPackageSelect);
				while($v = $q->fetch_array()) { ?>
					<option value="<?echo $v[0];?>"><?echo $v[0];?></option>
				<? }
			?>
		</select>
		<label>Package to combine</label>
	</div>
	<a id="requirementPackageCombine" class="waves-effect waves-light btn-large">Combine</a>
	<table class="striped" id="requirementPackageList"> 
		<?
			$q = mysqli_query(connect(), $kPackage) or die("ERROR: ".$kPackage);
			while($v = $q->fetch_array()) { ?>
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s2 requirementPackageDelete"><i class="material-icons">delete</i></a>
						<a class="col s7" href="packages.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a>
					</td>
				</tr>
			<? }
		?>
	</table>
</div>