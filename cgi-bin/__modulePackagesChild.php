<?
	$kChild = "select * from Packages where dad = '$id'";
?>
<div class="col s5 blue-grey">
	<h3>Child</h3>
	<table class="striped">
		<? 
			$q = mysqli_query(connect(), $kChild)or die("ERROR: ".$kChild); 
			while($v = $q->fetch_array()) { ?>
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s2 packageChildDelete"><i class="material-icons">delete</i></a>
						<a class="col s10" href="packages.php?id=<?echo $v[0];?>"><?echo $v[0];?></a>
					</td>
				</tr>
			<? } 
		?>
	</table>
</div>