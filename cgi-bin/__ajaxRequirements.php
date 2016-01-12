<? 
	require_once '__system.php';

	// Request type (insert, update, combine some entity, etc)
	$typeRequest = $_POST['typeRequest'];

	// Data passed for specific action
	$data = $_POST['data'];

	// Query to perform
	$k = ""; $k1 = "";

	// Database connection
	$link = connect();

	// Fix dad and numeration value of children with a previous numeration uncle deleted
	function fixChildren($old, $new) {
		$k = "select requirement from Requirements where dad = '$old'";
		$tmpConn = connect();
		$q = mysqli_query($tmpConn, $k) or die("ERRORE: " . $k);
		while($v = $q->fetch_array()) {
			$newRequirementId = $new . substr($v[0], strlen($new));
			$fix = mysqli_query($tmpConn, "SET FOREIGN_KEY_CHECKS = 0")or die("while setting check = 0");
			$x = "update Requirements set dad = '$new', requirement = '$newRequirementId' where dad = '$old' and requirement =  '$v[0]'";
			$q2 = mysqli_query($tmpConn, $x) or die("ERRORE: While change dad and requirement value ". $x);
			$unFix = mysqli_query($tmpConn, "SET FOREIGN_KEY_CHECKS = 1");
			fixChildren($v[0], $newRequirementId);
		}	
	}

	switch($typeRequest) {
		case('insert'):
			$data[4] = mysqli_real_escape_string(connect(),$data[4]);

			// Adding requirement without dad
			if($data[0] != '') {
				$k = mysqli_query($link, "select substr(requirement, 4, length(requirement)) from Requirements where dad = '$data[0]'") or die("err select future brother");
				$max = 0;
				while($v = $k->fetch_array()) {
					$tmp = explode(".", $v[0]);
					$tmp = $tmp[sizeof($tmp) - 1];
					$max = ($tmp > $max) ? $tmp : $max;
				}
				$max++;
				$newId = 'R' . $data[1] . substr($data[0],2,strlen($data[0])) . "." . $max;
				$k = "INSERT INTO Requirements(requirement,dad,description,source,satisfied) VALUES ('$newId','$data[0]','$data[4]','$data[3]','notSatisfied') ";
			} else {

				// Adding child requirement
				$k = "SELECT IDMAX FROM (SELECT CAST(SUBSTR(requirement,4,LENGTH(requirement)) AS UNSIGNED) AS IDMAX FROM Requirements) AS REQUISITIMAX ORDER BY IDMAX DESC LIMIT 1";
				$q = mysqli_query($link, $k) or die("ERROR: " . $k);
				$v = $q->fetch_array();
				$last = $v[0]+1;
				$newId = "R" . $data[1] . $data[2] . $last;
				$k = "INSERT INTO Requirements(requirement,dad,description,source,satisfied) VALUES ('$newId',NULL,'$data[4]','$data[3]','notSatisfied') ";
			}			
			break;

		case('update'):
			$data[1] = mysqli_real_escape_string(connect(), $data[1]);
			$id = $data[0];

			// Check if type is changed
			if(substr($data[0], 2, 1) != $data[3]) {
				$id = substr($data[0], 0, 2) . $data[3] . substr($data[0], 3);
			}

			// Check if importance is changed
			if(substr($data[0], 1, 1) != $data[2]) {
				$id = substr($data[0], 0, 1) . $data[2] . substr($data[0], 2);
			}

			/* 
				Need for MySQL limitation in cascading on same table.
				In this contest update row parent are referentiated by
					child on same table and that is not possibile.
				Well we disable before updating option FOREIGN_KEY_CHECKS,
					change parent row and all child of that and and after 
					udpating we re-able option.
			*/

			$k1 = "SET FOREIGN_KEY_CHECKS = 0" . "UPDATE Requirements SET requirement = '$id', description = '$data[1]', satisfied = '$data[5]' where requirement = '$data[0]'" . "update Requirements set dad = '$id' where dad = '$data[0]'" . "SET FOREIGN_KEY_CHECKS = 1";
			// Disable mysql foreign key check
			$fix = mysqli_query($link, "SET FOREIGN_KEY_CHECKS = 0")or die("ERROR: ");
			
			// Update parent row
			$k = mysqli_query($link, "UPDATE Requirements SET requirement = '$id', description = '$data[1]', satisfied = '$data[5]' where requirement = '$data[0]'")or die("ERROR");
			
			// Update child row
			$fix = mysqli_query($link, "update Requirements set dad = '$id' where dad = '$data[0]'")or die("ERROR: ");
			
			// Re-able mysql foreign key check
			$k = "SET FOREIGN_KEY_CHECKS = 1";
			break;

		case('delete'):

			// Save leve onto work
			$normalize = substr($data[0], 3);

			// Hierarchy of derivation
			$hierarchy = explode(".", $normalize);

			// Rappresent level of annidation of requirement
			$level = sizeof($hierarchy);

			// Rappresent actual index of deleted requirement between his brothers
			$childrenNumber = $hierarchy[$level - 1];

			// Select dad of deleted to fine brother
			$dad = mysqli_query($link, "select dad from Requirements where requirement = '$data[0]'") or die("ERRORE: while selecting dad of deleted");
			$dad = $dad->fetch_array();
			$dad = $dad[0];

			// Delete requiement and children
			$delete = mysqli_query(connect(), "delete from Requirements where requirement = '$data[0]'") or die("ERRORE: deleting");

			// Disable mysql foreign key check
			$k = "SET FOREIGN_KEY_CHECKS = 0";

			// Brother Fix
			$brotherFix = "";
			if($level > 1)
				$brotherFix = mysqli_query($link, "select requirement from Requirements where dad = '$dad'") or die("ERRORE: in brother selection");
			else
				$brotherFix = mysqli_query($link, "select requirement from Requirements where dad is NULL") or die("ERRORE: in brother selection");
			while($vBrotherFix = $brotherFix->fetch_array()) {
				$brotherNum = explode(".", $vBrotherFix[0])[0];
				$brotherNum = substr($brotherNum, 3);
				$deletedNum = explode(".", $data[0])[0];
				$deletedNum = substr($deletedNum, 3);
				if($brotherNum > $deletedNum) {
					$newRequirementId = "";
					if($level == 1) {
						$newRequirementId = substr($vBrotherFix[0], 0, 3) . $childrenNumber;
					} else {
						$tmp = $hierarchy;
						$tmp[sizeof($tmp) - 1] = $childrenNumber;
						$newRequirementId = join(".", $tmp);
					}
					$childrenNumber++;
					fixChildren($vBrotherFix[0], $newRequirementId);
					$fixBrotherRequiement = "update Requirements set requirement = '$newRequirementId' where requirement = '$vBrotherFix[0]'";
					$qFixBrotherRequirement = mysqli_query($link, $fixBrotherRequiement) or die("ERRORE: " . $fixBrotherRequiement);
				}
			}

			// Re-able mysql foreign key check
			$k = "SET FOREIGN_KEY_CHECKS = 1";
			break;
		
		case('classCombine'):
			$package = split(':',$data[1])[0];
			$class = split(':',$data[1])[1];
			$k = "insert into RequirementsClasses values ('$data[0]', '$class', '$package')";
			break;

		case('classDelete'):
			$package = split(':',$data[1])[0];
			$class = split(':',$data[1])[1];
			$k = "delete from RequirementsClasses where requirement = '$data[0]' and class = '$class' and package = '$package'";
			break;

		case('packageCombine'):
			$k = "insert into PackagesRequirements values ('$data[1]', '$data[0]')";
			break;

		case('packageDelete'):
			$k = "delete from PackagesRequirements where package = '$data[1]' and requirement = '$data[0]'";
			break;

		case('systemTestInsert'):
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "insert into SystemTests values ('$data[0]', '$data[1]', '$data[2]', '$data[3]')";
			break;

		case('systemTestUpdate'):
			$data[1] = mysqli_real_escape_string(connect(),$data[1]);
			$k = "update SystemTests set description = '$data[1]', implemented = '$data[2]', satisfied = '$data[3]' where requirement = '$data[0]'";
			break;
			
		case('usecaseCombine'):
			$k = "insert into RequirementsUsecases values ('$data[0]', '$data[1]')";
			break;

		case('usecaseDelete'):
			$k = "delete from RequirementsUsecases where requirement = '$data[0]' and usecase = '$data[1]'";
			break;

		case('validationTestInsert'):
			$k = "insert into ValidationTest values ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]')";
			break;

		case('validationTestStepInsert'):
			$k = "insert into ValidationTestStep values ('$data[0]', '$data[1]', '$data[2]')";
			break;

		case('validationTestUpdate'):
			$k = "update ValidationTest set description = '$data[2]', implemented = '$data[3]', satisfied = '$data[4]' where requirement = '$data[0]' and test = '$data[1]'";
			break;

		case('validationTestStepDeleteAll'):
			$k = "delete from ValidationTestStep where test = '$data[0]'";
			break;
	}
	if($k != "") {
		if(!mysqli_query($link, $k)) 
			echo "ERROR ". $typeRequest ."\n" . $k;
		else {
			echo "OPERAZIONE ESEGUITA CON SUCCESSO";
		}
	}
?>