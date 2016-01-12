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
			$data[2] = mysqli_real_escape_string($link,$data[2]); $data[2] = trim($data[2]);
			$data[3] = mysqli_real_escape_string($link,$data[3]); $data[3] = trim($data[3]);
			$data[4] = mysqli_real_escape_string($link,$data[4]); $data[4] = trim($data[4]);
			$data[5] = mysqli_real_escape_string($link,$data[5]); $data[5] = trim($data[5]);
			$data[6] = mysqli_real_escape_string($link,$data[6]); $data[6] = trim($data[6]);
			$data[7] = mysqli_real_escape_string($link,$data[7]); $data[7] = trim($data[7]);
			$data[8] = mysqli_real_escape_string($link,$data[8]); $data[8] = trim($data[8]);
			if($data[0] != '')
			{
				$max = 0;
				$leveldad = count(explode(".", $data[0]));
				$k = mysqli_query($link, "select usecase from Usecases where dad = '$data[0]'");
				while($v = $k->fetch_array()) {
					$levelsV = explode(".", $v[0]);
					$levelV = count($levelsV);
					if($levelV == $leveldad + 1) {
						if($levelsV[count($levelsV) - 1] > $max) {
							$max = $levelsV[count($levelsV) - 1];
						}
					}
				}
				$max++;
				$newId = $data[0] . "." . $max;
				$k = "INSERT INTO Usecases(usecase, dad, title, description, type, precondition, postcondition, imagePath, didascalia,scene,alternativeScene) VALUES	('$newId', '$data[0]', '$data[2]', '$data[3]', '$data[1]', '$data[4]', '$data[5]', '$data[9]', '$data[8]', '$data[6]', '$data[7]')";
			} else {
				$k = mysqli_query(connect(), "select usecase from Usecases where dad is NULL");
				$max = 0;
				while($v = $k->fetch_array()) {
					$value = explode("C", $v[0])[1];
					if($value > $max)
						$max = $value;
				}
				$max++;
				$newId = "UC" . $max;
				$k = "INSERT INTO Usecases(usecase, dad, title, description, type, precondition, postcondition, imagePath, didascalia, scene, alternativeScene) VALUES ('$newId', NULL, '$data[2]', '$data[3]', '$data[1]', '$data[4]', '$data[5]', '$data[9]', '$data[8]', '$data[6]', '$data[7]')";
			}
		break;

		case('update'):
			$data[2] = mysqli_real_escape_string($link,$data[2]); $data[2] = trim($data[2]);
			$data[3] = mysqli_real_escape_string($link,$data[3]); $data[3] = trim($data[3]);
			$data[4] = mysqli_real_escape_string($link,$data[4]); $data[4] = trim($data[4]);
			$data[5] = mysqli_real_escape_string($link,$data[5]); $data[5] = trim($data[5]);
			$data[6] = mysqli_real_escape_string($link,$data[6]); $data[6] = trim($data[6]);
			$data[7] = mysqli_real_escape_string($link,$data[7]); $data[7] = trim($data[7]);
			$data[8] = mysqli_real_escape_string($link,$data[8]); $data[8] = trim($data[8]);
			$data[9] = mysqli_real_escape_string($link,$data[9]); $data[9] = trim($data[9]);
			$k = "UPDATE Usecases SET title = '$data[2]', description = '$data[3]', type = '$data[1]', precondition = '$data[4]', postcondition = '$data[5]', scene = '$data[6]', alternativescene = '$data[7]', didascalia = '$data[8]', imagePath = '$data[9]' WHERE usecase = '$data[0]'";
			break;

		case('delete'):
			$k = "delete from Usecases where usecase = '$data[0]'";		
			break;

		case('childDelete'):
			$k = "delete from Usecases where usecase = '$data[0]'";
			break;

		case('actorCombine'):
			$k = "insert into ActorUsecases values ('$data[1]', '$data[0]')";
			break;

		case('actorDelete'):
			$k = "delete from ActorUsecases where usecase = '$data[0]' and actor = '$data[1]'";
			break;

		case('verbalCombine'):
			$k = "insert into UsecasesVerbals values ('$data[0]', '$data[1]')";
			break;

		case('verbalDelete'):
			$k = "delete from UsecasesVerbals where usecase = '$data[0]' and verbal = '$data[1]'";
			break;

		case('requirementCombine'):
			$k = "insert into RequirementsUsecases values ('$data[1]', '$data[0]')";
			break;

		case('requirementDelete'):
			$k = "delete from RequirementsUsecases where usecase = '$data[0]' and requirement = '$data[1]'";
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