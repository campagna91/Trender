<?
	$kRequirement = "select requirement from PackagesRequirements where package = '$id'";
	$kRequirementSelect = "select requirement from Requirements where requirement not in (" . $kRequirement . ")";
?>
<div class="col s5 offset-s2 blue-grey" id="packagesRequirement">
	<h3>Requirements</h3>

	<!-- Requirement -->
	<div class="input-field col s12">
		<select id="packageRequirement" class="validate">
			<option value="">Select a requirement</option>
			<?
				$q = mysqli_query(connect(), $kRequirementSelect) or die("ERROR: ".$kRequirementSelect);
				while($v = $q->fetch_array()) { ?> 
					<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option>
				<? } 
			?>
		</select>
		<label>Requirement</label>
		<a id="packageRequirementCombine" class="waves-effect waves-light btn-large">Combine</a>

		<table class="striped" id="packageRequirementList">
			<?
				$q = mysqli_query(connect(), $kRequirement) or die("ERROR: ".$kRequirement);
				while($v = $q->fetch_array()) { ?>	
					<tr id="<? echo $v[0] ?>">
						<td>
							<a class="waves-light btn red col s2 packageRequirementDelete"><i class="material-icons">delete</i></a>
							<a class="col s10" href="requirements.php?id=<?echo $v[0];?>"><?echo $v[0];?></a>
						</td>
					</tr>
				<? } 
			?>
		</table>
	</div>
</div>