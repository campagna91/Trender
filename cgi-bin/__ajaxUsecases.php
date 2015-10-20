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
			$data[2] = mysqli_real_escape_string($link,$data[2]);
			$data[3] = mysqli_real_escape_string($link,$data[3]);
			$data[4] = mysqli_real_escape_string($link,$data[4]);
			$data[5] = mysqli_real_escape_string($link,$data[5]);
			$data[6] = mysqli_real_escape_string($link,$data[6]);
			$data[7] = mysqli_real_escape_string($link,$data[7]);
			$data[8] = mysqli_real_escape_string($link,$data[8]);
			if($data[0] != '')
			{
				$last = 0;
				$k = "SELECT IDMAX FROM (SELECT CAST(SUBSTR(usecase,LENGTH('$data[0]') + 2, LENGTH(usecase)) AS UNSIGNED) AS IDMAX FROM Usecases WHERE dad = '$data[0]' ORDER BY IDMAX DESC) AS UsecasesMAX LIMIT 1";
				$q = mysqli_query($link, $k) or die("ERROR: " . $k);
				$v = $q->fetch_array();
				$last = $v[0] + 1;
				$newId = $data[0] . "." . $last;
				$k = "INSERT INTO Usecases(usecase, dad, title, description, type, precondition, postcondition, imagePath, didascalia,scene,alternativeScene) VALUES	('$newId', '$data[0]', '$data[2]', '$data[3]', '$data[1]', '$data[4]', '$data[5]', '$data[9]', '$data[8]', '$data[6]', '$data[7]')";
			} else {
				$k = "SELECT IDMAX FROM ( SELECT CAST(SUBSTR(usecase,3,LENGTH(usecase)) AS UNSIGNED) AS IDMAX FROM Usecases ORDER BY IDMAX DESC ) AS UsecasesMAX LIMIT 1";
				$q = mysqli_query($link, $k) or die("USECASE : (new) ".$k);
				$v = $q->fetch_array();
				$last = $v[0]+1;
				$newId = "UC" . $last;
				$k = "INSERT INTO Usecases(usecase, dad, title, description, type, precondition, postcondition, imagePath, didascalia, scene, alternativeScene) VALUES ('$newId', NULL, '', '$data[3]', '$data[1]', '$data[4]', '$data[5]', '$data[9]', '$data[8]', '$data[6]', '$data[7]')";
			}
		break;

		case('update'):
			$data[2] = mysqli_real_escape_string($link,$data[2]);
			$data[3] = mysqli_real_escape_string($link,$data[3]);
			$data[4] = mysqli_real_escape_string($link,$data[4]);
			$data[5] = mysqli_real_escape_string($link,$data[5]);
			$data[6] = mysqli_real_escape_string($link,$data[6]);
			$data[7] = mysqli_real_escape_string($link,$data[7]);
			$data[8] = mysqli_real_escape_string($link,$data[8]);
			$data[9] = mysqli_real_escape_string($link,$data[9]);
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
	}
	if($k != "") {
		if(!mysqli_query($link, $k)) 
			echo "ERROR ". $typeRequest ."\n" . $k;
		else {
			echo $k;
		}
	}
?>