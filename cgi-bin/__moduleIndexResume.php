<?
require_once('__system.php');

	/**
	 * Calculate number of type's requirement.
	 * If type isn't provide, function return count of all requirements
	 */
	function countTypeRequirements($type) {
		if($type == '') 
			$q = mysqli_query(connect(), "select count(requirement) as n from Requirements") or die("Error while selecting count of requirement type");
		else
			$q = mysqli_query(connect(), "select count(requirement) as n from Requirements where SUBSTR(requirement, 3, 1) = '$type'") or die("Error while selecting count of requirement type");
		$n = $q->fetch_array();
		return $n[0];
	}

	/**
	 * Calculate number of level's requirement.
	 */
	function countLevelRequirement($level) {
		$q = mysqli_query(connect(), "select count(requirement) as n from Requirements where SUBSTR(requirement, 2, 1) = $level") or die("Error while selecting count of requirement level");
		$n = $q->fetch_array();
		return $n[0];
	}

	/**
	 * Calculate number of type's requirement satisfied
	 */
	function countSatisfiedTypeRequirements($type) {
		if($type == '')
			$q = mysqli_query(connect(), "select count(requirement) as n from Requirements where satisfied = 'satisfied'") or die("Error while selecting count of satisfied requirement type");
		else
			$q = mysqli_query(connect(), "select count(requirement) as n from Requirements where SUBSTR(requirement, 3, 1) = '$type' and satisfied = 'satisfied'") or die("Error while selecting count of satisfied requirement type");
		$n = $q->fetch_array();
		return $n[0];	
	}

	/**
	 * Calculate number of level's requirement satisfied
	 */
	function countSatisfiedLevelRequirement($level) {
		$q = mysqli_query(connect(), "select count(requirement) as n from Requirements where SUBSTR(requirement, 2, 1) = '$level' and satisfied = 'satisfied'") or die("Error while selecting count of satisfied requirement type");
		$n = $q->fetch_array();
		return $n[0];	
	}

	function percentualCalculation($set, $subset) {
		if($subset != 0 && $set != 0) {
			$average = round((($subset * 100) / $set), 2);
			if($average <= 50) 
				echo "<span class='r'>$average %</span>";
			else 
				echo "<span class='g'>$average %</span>";
		}
		if($subset == 0 || $set == 0) {
			if($set == 0) {
				echo "<span class='g'>NA</span>";
				return;
			} else {
				echo "<span class='r'>0%</span>";
				return;
			}
		} 
		else 
			return 0;
	}

	function fetch($query) {
		$tmp = $query->fetch_assoc();
		$tmp = $tmp['count'];
		echo $tmp;
	}

	// Usecases count
	$qUsecase = mysqli_query(connect(), "select count(usecase) as count from Usecases") or die("Error while counting usecases");

	// Verbals
	$qVerbals = mysqli_query(connect(), "select count(date) as count from Verbals") or die("Error while counting verbals");

	// Actors
	$qActors = mysqli_query(connect(), "select count(actor) as count from Actors") or die("Error while counting actors");

	// Packages
	$qPackages = mysqli_query(connect(), "select count(package) as count from Packages") or die("Error while counting packages");

	// Classes
	$qClasses = mysqli_query(connect(), "select count(class) as count from Classes") or die("Error while selecting class");

	// System test

	// Validation test

	// Integration test
?>

<div class="row" id="moduleResume">

	<div class="col s3 blue-grey">
		<h2> Requisiti </h2>
		<p>Totali Soddisfatti <?
			percentualCalculation(countTypeRequirements(''), countSatisfiedTypeRequirements('')); ?>
		</p>
		<p>Funzionali soddisfatti <?
			percentualCalculation(countTypeRequirements('F'), countSatisfiedTypeRequirements('F')); ?>
		</p>
		<p>Vincolanti soddisfatti <?
			percentualCalculation(countTypeRequirements('V'), countSatisfiedTypeRequirements('V')); ?>
		</p>
		<p>Performanti soddisfatti <?
			percentualCalculation(countTypeRequirements('P'), countSatisfiedTypeRequirements('P')); ?>
		</p>
		<p>Qualitativi soddisfatti <?
			percentualCalculation(countTypeRequirements('Q'), countSatisfiedTypeRequirements('Q')); ?>
		</p>
		<p>Obbligatori soddisfatti <?
			percentualCalculation(countLevelRequirement(0), countSatisfiedLevelRequirement(0)); ?>
		</p>
		<p>Desiderabili soddisfatti <?
			percentualCalculation(countLevelRequirement(1), countSatisfiedLevelRequirement(1)); ?>
		</p>
		<p>Opzionali soddisfatti <?
			percentualCalculation(countLevelRequirement(2), countSatisfiedLevelRequirement(2)); ?>
		</p>
	</div>

	<div class="col s2 blue-grey">
		<h2>Usecase</h2>
		<h3><? fetch($qUsecase); ?></h3>
	</div>

	<div class="col s2 blue-grey">
		<h2>Packages</h2>
		<h3><? fetch($qPackages); ?></h3>
	</div>

	<div class="col s2 blue-grey">
		<h2>Actors</h2>
		<h3><? fetch($qActors); ?></h3>
	</div>

	<div class="col s2 blue-grey">
		<h2>Classes</h2>
		<h3><? fetch($qClasses); ?></h3>
	</div>

	<div class="col s2 blue-grey">
		<h2>Verbals</h2>
		<h3><? fetch($qVerbals); ?></h3>
	</div>

</div>