<?
	$kChild = "select * from Requirements where dad = '$id' order by length(requirement)";
	$q = mysqli_query(connect(),$kChild) or die("ERROR: ".$kChild); 
?>
<div class="col s3 offset-s1 blue-grey" id="requirementsChild">
	<h3>Sons</h3>
	<table class="striped"> 
		<?
			while($v = $q->fetch_array())	{ ?>
				<tr id="<? echo $v[0] ?>">
					<td>
						<a class="waves-light btn red col s3 requirementChildDelete"><i class="material-icons">delete</i></a>
						<a class="col s7" href="requirements.php?id=<? echo $v[0] ?>"><? echo $v[0] ?></a>
					</td>
				</tr>
			<? } 
		?>
	</table>
</div>