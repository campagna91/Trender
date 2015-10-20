<? 
	require_once '__system.php';

	// Request type (insert, update, combine some entity, etc)
	$typeRequest = $_POST['typeRequest'];

	// Data passed for specific action
	$data = $_POST['data'];

	// Query to perform
	$k = "";

	// Database connection
	$link = connect();

	switch($typeRequest) {
		case('insert'):
			$data[4] = mysqli_real_escape_string(connect(),$data[4]);

			// Adding requirement without dad
			if($data[0] != '') {
				$k = "SELECT IDMAX FROM (SELECT CAST(SUBSTR(requirement,LENGTH('$data[0]')+2,LENGTH(requirement)) AS UNSIGNED) AS IDMAX FROM Requirements WHERE dad = '$data[0]' ORDER BY IDMAX DESC ) AS REQUISITIMAX	LIMIT 1";
				$q = mysqli_query($link, $k) or die("ERROR: ".$k);
				$v = $q->fetch_array();
				$last = $v[0]+1;					
				$newId = 'R' . $data[1] . substr($data[0],2,strlen($data[0])) . "." . $last;
				$k = "INSERT INTO Requirements(requirement,dad,description,source,satisfied) VALUES ('$newId','$data[0]','$data[4]','$data[3]','notSatisfied') ";
			} else {

				// Adding child requirement
				$k = "SELECT IDMAX FROM (SELECT CAST(SUBSTR(requirement,4,LENGTH(requirement)) AS UNSIGNED) AS IDMAX FROM Requirements ORDER BY IDMAX DESC ) AS REQUISITIMAX LIMIT 1";
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

			// Disable mysql foreign key check
			$fix = mysqli_query($link, "SET FOREIGN_KEY_CHECKS = 0")or die("ERROR: ");

			// Update parent row
			$k = mysqli_query($link, "UPDATE Requirements SET requirement = '$id', description = '$data[1]', satisfied = '$data[5]' where requirement = '$data[0]'")or die("ERROR");

			// Update child row
			$fix = mysqli_query($link, "update Requirements set dad = '$id' where dad = '$data[0]'")or die("ERROR: ");

			// Re-able mysql foreign key check
			$k = "SET FOREIGN_KEY_CHECKS = 1";
			break;

		case('childDelete'):
		case('delete'):
			$k = "delete from Requirements where requirement = '$data[0]'";	
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
	}
	if($k != "") {
		if(!mysqli_query($link, $k)) 
			echo "ERROR ". $typeRequest ."\n" . $k;
		else {
			echo $k;
		}
	}
?>