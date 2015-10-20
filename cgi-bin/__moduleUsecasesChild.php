<? 
	$kChild = "select * from Usecases where dad = '$id' ORDER BY LENGTH(usecase)";
	$q = mysqli_query(connect(),$kChild) or die("MODCHILD : (usecase) ".$kChild); 
?>
<div class="col s3 blue-grey">
	<h3>Child</h3>
	<table class="striped"> 
		<?
			while($v = $q->fetch_array())	{ ?>
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s2 usecaseChildDelete"><i class="material-icons">delete</i></a>
						<a class="col s8 center" href="usecases.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a>
					</td>
				</tr> 
			<? } 
		?>
	</table>
</div>