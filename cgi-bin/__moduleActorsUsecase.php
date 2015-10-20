<?
	$kUsecase = "select usecase from ActorUsecases where actor = '$id'";
	$kUsecaseSelect = "select * from usecases where usecase not in (" . $kUsecase . ")";
?>

<div class=" col s7 blue-grey offset-s1" id="actorsUsecase">
	<h3>Usecases</h3>
	<div class="input-field col s12">
		<select id="actorUsecase" class="validate">
			<option value="">Select an usecase</option> 
				<?
					$q = mysqli_query(connect(), $kUsecaseSelect) or die("ERROR: " . $kUsecaseSelect);
					while($v = $q->fetch_array()) { ?> 
						<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option> 
					<? } 
				?>
		</select>
		<label>Usecase</label>
		<a id="actorUsecaseCombine" class="waves-effect waves-light btn-large">Combine</a>
	</div>
	<table class="striped" id="actorUsecaseList"> 
		<?
			$q = mysqli_query(connect(), $kUsecase) or die("USECASE: ".$kUsecase);
			while($v = $q->fetch_array()) { ?> 
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s2 actorUsecaseDelete"><i class="material-icons">delete</i></a>
						<a class="col s10" href="usecases.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a>
					</td>
				</tr> 
			<? } 
		?>
	</table>
</div>