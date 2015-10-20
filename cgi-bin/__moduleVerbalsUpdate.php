<? 
	require_once('__system.php');
	$id = $_GET['id'];
	$kUpdate = "select * from Verbals where date = '$id' "; 
?>
<div class="row blue-grey">
	<h3>Update</h3>
	<? 
		$q = mysqli_query(connect(),$kUpdate)or die("ERRROR: ".$kUpdate);
		$v = $q->fetch_array();
	?>
	<div class="row">

		<!-- Date -->
		<div class="input-field col s2 offset-s5">
			<input id="date" type="date" class="datepicker">
			<label for="date">Date</label>
			<script>
				$('.datepicker').pickadate({
			    selectMonths: true, // Creates a dropdown to control month
			    selectYears: 15, // Creates a dropdown of 15 years to control year
			    format: 'yyyy-mm-dd'
			  });
				$input = $('#date').pickadate()
				var picker = $input.pickadate('picker');
				picker.set('select', "<? echo $v[0] ?>", { format: 'yyyy-mm-dd' });
			</script>
		</div>
	</div>

	<div class="row">

		<!-- Tect -->
		<div class="input-field cols s12">
			<textarea id="text" class="materialize-textarea"><? echo $v[1] ?></textarea>
			<label for="text">Text</label>
		</div>
	</div>
</div>