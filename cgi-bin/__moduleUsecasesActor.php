<?
	$kActor = "select actor from ActorUsecases where usecase = '$id'";
	$kActorSelect = "select actor from Actors where actor not in ( select actor from ActorUsecases where usecase = '$id' ) ";
?>
<div class="col s3 offset-s1 blue-grey" id="usecasesActors">
	<h3>Actors</h3>

	<!-- Actor -->
	<div class="input-field col s12">
		<select id="usecaseActorName" class="validate">
			<option value="">Select an actor</option> 
				<?
					$q = mysqli_query(connect(), $kActorSelect) or die("ERROR: ".$kActorSelect);
					while($v = $q->fetch_array()) { ?> 
						<option value="<? echo $v[0] ?>"><? echo $v[0] ?></option> 
					<? } 
				?>
		</select>
		<a id="usecaseActorCombine" class="waves-effect waves-light btn-large">Combine</a>
	</div>
	
	<table class="striped" id="usecaseActorList"> 
		<?
			$q = mysqli_query(connect(),$kActor) or die("ERROR: ".$kActor);
			while($v = $q->fetch_array()) { ?>
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s2 usecaseActorDelete"><i class="material-icons">delete</i></a>
						<a class="col s10" href="actors.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a>
					</td>
				</tr> 
			<? } 
		?>
	</table>
</div>