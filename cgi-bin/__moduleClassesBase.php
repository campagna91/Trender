<?

	// Define all class 
	$all = [];
	$qA = mysqli_query(connect(), "select class, package from Classes");
	while($v = $qA->fetch_array()) {
		$tmp = [$v[1], $v[0]];
		array_push($all, $tmp);
	}
		
	// Define all kindren in class hierarchy
	$common = [];
	$tmp = [$package, $id];
	array_push($common, $tmp);
	function child($class, $package, &$kin) {
		$k = "select derivative, derivativePackage from ClassInheritance where base = '$class' and basePackage = '$package'";
		$q = mysqli_query(connect(), $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) {
			$tmp = [$v[1], $v[0]];
			array_push($kin, $tmp);
			child($v[0], $v[1], $kin);
		}
	}
	child($id, $package, $common);

	// Define base class
	$base = [];
	$q = mysqli_query(connect(), "select base, basePackage from ClassInheritance where derivative = '$id' and derivativePackage = '$package'");
	while($v = $q->fetch_array()) {
		$tmp = [$v[1], $v[0]];
		array_push($base, $tmp);
	}

	// Arrays merge
	$common = array_merge($common, $base);
	
	$aux = $all;
	
	// Remove class not relationable as base class
	foreach($all as $i => $x) {	
		foreach($common as $j => $k) {
			if($x[0] == $k[0] && $x[1] == $k[1]) {
				unset($aux[$i]);
				break;
			}
		}
	}
	
?>
<div class="col s3 offset-s1 blue-grey" id="classesBase">
	<h3>Base classes</h3>

	<!-- Base -->
	<div class="input-field col s12">
		<select id="base" class="validate">
			<option value=''>Select a base class</option>
			<?
				foreach($aux as $i => $x) { ?>
			 		<option value="<? echo $x[0] . '.' . $x[1] ?>"><? echo $x[0] . '.' . $x[1] ?></option>
				<? }
			?>
		</select>
		<label>Base class</label>
		<a id="classBaseInsert" class="waves-effect waves-light btn-large">INHERITS</a>
	</div>

	<div class="input-field col s12 " id="classBaseList">
	<?
		foreach($base as $i => $x) { ?>
			 <div class="chip" >
			 	<a href="classes.php?id=<? echo $x[1] ?>&package=<? echo $x[0] ?>"><? echo $x[0] . '.' . $x[1] ?></a>
			 	<i class="material-icons classBaseDelete">close</i>
		 	</div>
		<? }
	?>
	</div>
</div>
