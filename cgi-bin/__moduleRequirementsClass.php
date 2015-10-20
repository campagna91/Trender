<? 
	$kClassSelect = "select class, package from Classes where class not in (select class from RequirementsClasses where requirement = '$id') order by class, length(class)";
	$kClass = "select class, package from RequirementsClasses where requirement = '$id'";
?>
<div class="col blue-grey s5 offset-s1" id="requirementClass">
	<h3>Classes</h3>
		<div class="input-field col s12">
		<select id="requirementClassName" class="validate">
			<option value=''>Select a class</option>
			<?
				$q = mysqli_query(connect(), $kClassSelect) or die("ERRORE: ".$kClassSelect);
				while($v = $q->fetch_array()) { ?>
					<option value="<? echo $v[1].":".$v[0];?>"><? echo $v[1].":".$v[0];?></option>
				<? }
			?>
		</select>
		<label>Class to combine</label>
	</div>
	<a id="requirementClassCombine" class="waves-effect waves-light btn-large">Combine</a>
	<table class="striped" id="requirementClassList"> 
		<?
			$q = mysqli_query(connect(), $kClass) or die("errore reperimento prorpie ".$kClass);
			while($v = $q->fetch_array()) { ?>
				<tr id="<? echo $v[1].":".$v[0] ?>">
					<td>
						<a class="waves-light btn red col s2 requirementClassDelete"><i class="material-icons">delete</i></a>
						<a class="col s10" href="classes.php?id=<? echo $v[0] ?>&package=<? echo $v[1] ?>"><?echo $v[1].":".$v[0] ?></a>
					</td>
				</tr> 
			<? } 
		?>
	</table>
</div>