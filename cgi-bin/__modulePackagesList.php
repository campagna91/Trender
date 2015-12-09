<? require_once '__system.php'; 
	function EF($package) {
		$kEF = "select classStart, classEnd from ClassRelations where classStart in ( select class from Classes where package = '$package') and classEnd not in ( select class from Classes where package = '$package')";
		$qEF = mysqli_query(connect(), $kEF) or die("Errore selezione classi esterne al package");
		$numEF = mysqli_num_rows($qEF);
		return $numEF;
	}
	function AF($package) {
		$kAF = "select classStart, classEnd from ClassRelations where classStart not in (select class from Classes where package = '$package') and classEnd in (select class from Classes where package = '$package')";
		$qAF = mysqli_query(connect(), $kAF) or die("Errore selezione classi AF". $kAF);
		$numAF = mysqli_num_rows($qAF);
		return $numAF;
	} 
?>
<div class="col s10 offset-s1" id="mainList">
	<table class="striped">
		<thead>
			<tr>
				<th>Package</th>	
				<th>Dad</th>
				<th class="left">Description</th>
				<th>Afferent</th>
				<th>Efferent</th>
				<th>Instability</th>
			</tr>
		</thead>
		<tbody> <?
		function modListRecursive($child = 0, $id = 'none'){
			if(!$child)
				$k = "select package,dad,description from Packages where dad is NULL order by length(package),package";
			else 
				$k = "select package,dad,description from Packages where dad = '$id' order by length(package),package";
			$q = mysqli_query(connect(),$k)or die("Err");
			$ef = $af = $i = 0;
			while($v = $q->fetch_array()) { 
				$ef = EF($v[0]); $af = AF($v[0]); 
				if($ef != 0)
					$inst = $af / ( $ef + $af);
				else 
					$inst = 0; ?>
				<tr class="<? echo $v[0] ?>">
					<td class="target"><a href="packages.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a></td>
					<td><a href="packages.php?id=<? echo $v[1] ?>"><? echo $v[1] ?></a></td>
					<td><? echo $v[2] ?></td>
					<td class="center"><? echo $af ?></td>
					<td class="center"><? echo $ef ?></td>
					<td class="center"><? echo $inst ?></td>
				</tr><?
				modListRecursive(1,$v[0]);
			}
		}
		modListRecursive();
		?>
	</table>
</div>
<script>
	truncate("mainList");
</script>
