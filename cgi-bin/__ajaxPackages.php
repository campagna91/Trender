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

	switch($typeRequest){
		case('insert'):
			$data[2] = mysqli_real_escape_string($link, $data[2]);
			$data[4] = mysqli_real_escape_string($link, $data[4]);
			if($data[0] != '') {
				if(!esiste($data[1])) 
					$k = "insert into Packages (package, dad, description, imagePath, didascalia) value('$data[1]', '$data[0]', '$data[2]', '$data[3]', '$data[4]')";
				else 
					break;
			} else 
				$k = "insert into Packages (package, dad, description, imagePath, didascalia) value('$data[1]', NULL, '$data[2]', '$data[3]', '$data[4]')";			
			break;

		case('update'):
			$data[2] = mysqli_real_escape_string($link, $data[2]);
			$data[3] = mysqli_real_escape_string($link, $data[3]);
			$data[5] = mysqli_real_escape_string($link, $data[5]);
			if( ($data[0] != $data[2] && !esiste($data[2])) || $data[0] == $data[2]) {
					
				// Disable mysql foreign key check
				$fix = mysqli_query($link, "SET FOREIGN_KEY_CHECKS = 0")or die("ERROR");

				// Update parent row
				if($data[1] == '')
					$k = mysqli_query($link, "UPDATE Packages SET package = '$data[2]', dad = NULL, description = '$data[3]', imagePath = '$data[4]', didascalia = '$data[5]' where package = '$data[0]'") or die("ERROR");
				else
					$k = mysqli_query($link, "UPDATE Packages SET package = '$data[2]', dad = '$data[1]', description = '$data[3]', imagePath = '$data[4]', didascalia = '$data[5]' where package = '$data[0]'") or die("ERROR");

				// Update child row
				$fix = mysqli_query($link, "update Packages set dad = '$data[2]' where dad = '$data[0]'") or die("ERROR");

				// Re-able mysql foreign key check
				$k = "SET FOREIGN_KEY_CHECKS = 1";
			}
			break;

		case('childDelete'):
		case('delete'):
			$k = "delete from Packages where package = '$data[0]'";
			break;

		case('requirementCombine'):
			$k = "insert into PackagesRequirements values('$data[0]', '$data[1]')";
			break;

		case('requirementDelete'):
			$k = "delete from PackagesRequirements where package = '$data[0]' and requirement = '$data[1]'";
			break;

		case('integrationInsert'):
			$k = "insert into IntegrationTest (package, description, implemented, satisfied) values ('$data[0]', '$data[1]', '$data[2]', '$data[3]')";
			break;

		case('integrationUpdate'):
			$k = "update IntegrationTest set description = '$data[1]', implemented = '$data[2]', satisfied = '$data[3]' where package = '$data[0]'";
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