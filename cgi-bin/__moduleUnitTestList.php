<?
require_once('__system.php');?>
<table>
	<tr>
		<th></th>
		<th>ID</th>
		<th>Description</th>
		<th>Class.method</th>
	</tr><?
	$k = "select * from UnitTest order by idUT";
	$q = mysqli_query(connect(),$k) or die("MODLIST : (class)".$k);
	while($v = $q->fetch_array())
	{?>
		<tr class="<?echo $v[0];?>">
			<td class="typeCommand">
				<button class="mainListDelete actionDelete">-</button>
				<button class="moduleUpdateSwitchImplementedNotImplemented <?if($v[3]) echo 'typeSatisfied'; else echo 'typeNotsatisfied';?>">IMPL</button>
			</td>
			<td><? echo $v[0];?></td>
			<td><? echo $v[1];?></td>
			<td>
				<ul><?
					$split = split(";", $v[2]);
					$i = 0; 
					while($i < count($split)-1 )
					{?>
						<li><? echo $split[$i]; $i++; ?></li><?
					}?>
				</ul>
			</td>
		</tr><?
	}?>
</table>