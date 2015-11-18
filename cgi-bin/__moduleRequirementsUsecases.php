<?
	$kUsecase = "select u.usecase, u.title from RequirementsUsecases r join Usecases u 	on r.usecase = u.usecase and r.requirement = '$id'";
	$kUsecaseSelect = "select usecase, title from Usecases where usecase not in (select usecase from RequirementsUsecases where requirement = '$id')";
?>
<div class="col blue-grey s6 offset-s1" id="requirementUsecase">
	<h3>Usecases</h3>

	<div class="input-field col s12">
		<select id="requirementUsecaseName" class="validate">
			<option value=''>Select an usecase</option>
			<?
				$q = mysqli_query(connect(), $kUsecaseSelect) or die("ERRORE: ".$kUsecaseSelect);
				while($v = $q->fetch_array()) { ?>
					<option value="<? echo $v[0] ?>"><? echo $v[0] . " - " . $v[1] ?></option>
				<? } 
			?>
		</select>
		<label>Usecase to combine</label>
	</div>
	<a id='requirementUsecaseCombine' class='waves-effect waves-light btn-large col s12'>Combine</a>
	<table class="striped" id="requirementUsecaseList">
		<?
			$q = mysqli_query(connect(), $kUsecase) or die("ERRORE: ".$kUsecase);
			while($v = $q->fetch_array()) { ?>
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s2 requirementUsecaseDelete"><i class="material-icons">delete</i></a>
						<a class="col s10" href="usecases.php?id=<? echo $v[0] ?>"><?echo $v[0] . " - " . $v[1]?></a>
					</td>
				</tr> 
			<? } 
		?>
	</table>
</div>