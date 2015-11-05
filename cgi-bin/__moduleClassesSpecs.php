<? 
	require_once('__system.php');
	$id = $_GET['id'];
?>

	<h1 id="id"><? echo $id ?></h1>	
	
	<? include_once('__moduleClassesUpdate.php'); ?>

	<div class="row">
		<?
			include_once('__moduleClassesBases.php');

			include_once('__moduleClassesDerivatives.php');

			include_once('__moduleClassesRelations.php');
		?>
	</div>

	<? 
		//include_once('__moduleClassesAttributes.php'); 

		//include_once('__moduleClassesMethods.php'); 		

	?>

