<? 
	$kVerbal = "select verbal from UsecasesVerbals where usecase = '$id'";
	$kVerbalSelect = "select date from Verbals where date not in (" . $kVerbal . ")";
?>
<div class="col s12 blue-grey" id="usecasesVerbal">
	<h3>Verbals</h3>

	<!-- Verbal -->
	<div class="input-field col s12">
		<select id="usecaseVerbal" class="validate">
			<option value="">Select a verbal</option> 
			<?
				$q = mysqli_query(connect(), $kVerbalSelect) or die("ERRORE: " . $kVerbalSelect);
				while($v = $q->fetch_array()) { ?>
					<option value="<? echo $v[0] ?>"><? echo $v[0] ?> </option>
				<? } 
			?>
		</select>
		<a id="usecaseVerbalCombine" class="waves-effect waves-light btn-large">Combine</a>
	</div>

	<table class="striped" id="usecaseVerbalList"> 
		<?
			$q = mysqli_query(connect(), $kVerbal) or die("ERROR: " . $kVerbal);
			while($v = $q->fetch_array()) { ?>
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s1 usecaseVerbalDelete"><i class="material-icons">delete</i></a>
						<a class="col s11" href="verbals.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a>
					</td>
				</tr>
			<?	} 
		?>
	</table>
</div>