<?
require_once('__system.php');?>
<div id="moduleResume"><?
	$k = "select * from Requisiti ";
	$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (requisiti) ".$k);
	$numR = mysqli_num_rows($q);
	$k = "select * from Requisiti where soddisfatto = 1";
	$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (requisiti) ".$k);
	$numRS = mysqli_num_rows($q);
	if($numRS) $perc = round(($numRS * 100 /$numR),2);
	else $perc = 0;
	$k = "select * from CasiUso "; 
	$q = mysqli_query(connect(),$k) or die ("MODINDEXRESUME : (usecase) ".$k);
	$numC = mysqli_num_rows($q);
	$k = "select * from Verbali ";
	$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (verbali) ".$k);
	$numV = mysqli_num_rows($q);
	$k = "select * from Attori ";
	$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (attori) ".$k);
	$numA = mysqli_num_rows($q);
	$k = "select * from Package ";
	$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (package) ".$k);
	$numP = mysqli_num_rows($q);
	$k = "select * from Classi ";
	$q = mysqli_query(connect(),$k) or die("MODINDEXRESUME : (classi) ".$k);
	$numCl = mysqli_num_rows($q);?>
	<div class="resume" id="resumeRequirement">
		<h2>REQUIREMENT</h2>
		<h4>Totali : <?echo $numR;?><h4>
		<h4>Soddisfatti : <?echo $numRS;?></h4>
		<h3><?echo $perc."% DO IT! ";?></h3>
	</div>
	<div class="resume" id="resumeUsecase">
		<h2>USECASE</h2>
		<h4>Totali <?echo $numC;?></h4>
	</div>
	<div class="resume" id="resumeActor">
		<h2>ACTOR</h2>
		<h4>Totali : <?echo $numA;?></h4>
	</div>
	<div class="resume" id="resumeVerbali">
		<h2>VERBAL</h2>
		<h4>Totali : <?echo $numV;?></h4>
	</div>
	<div class="resume" id="resumePackage">
		<h2>PACKAGE</h2>
		<h4>Totali : <?echo $numP;?></h4>
	</div>
	<div class="resume" id="resumeClass">
		<h2>CLASSI</h2>
		<h4>Totali : <?echo $numCl;?></h4>
	</div>
</div>