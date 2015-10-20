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
			$data[0] = mysqli_real_escape_string($link,$data[0]);
			$data[1] = mysqli_real_escape_string($link,$data[1]);
			$data[2] = mysqli_real_escape_string($link,$data[2]);
			if(!esiste($data[0]))
				$k = "insert into Actors values ('$data[0]', '$data[1]')";

			// Defined base actor
			if($data[2] != '') {

				// Execute prev query
				$q = mysqli_query($link, $k) or die("ERRORE: " . $k);

				// Insert inheritance
				$k = "insert into ActorsInheritance values ('$data[2]', '$data[0]')";

			}
			break;

		case('delete'):
			$k = " delete from Actors where actor = '$data[0]'";
			break;

		case('update'):
			$data[1] = mysqli_real_escape_string($link,$data[1]);
			$data[2] = mysqli_real_escape_string($link,$data[2]);
			$data[3] = mysqli_real_escape_string($link,$data[3]);
			if(($data[0] != $data[1] && !esiste($data[1])) || $data[0] == $data[1])  {
				$k = "UPDATE Actors SET actor = '$data[1]', note = '$data[2]' WHERE actor = '$data[0]'";
				$q = mysqli_query($link, $k) or die("ERRORE: " . $k);

				// if inheritance is specified we can have 3 possibilities:
				
				// 1: Base class must be delete
				if($data[3] == '') {
					$k = "delete from ActorsInheritance where derivative = '$data[0]'";

				} else {
					$q = mysqli_query($link, "select * from ActorsInheritance where derivative = '$data[1]'");
					$r = mysqli_num_rows($q);
					
					// 2: Base class doesn't yet exist
					if($r == 0)
						$k = "insert into ActorsInheritance values ('$data[3]', '$data[1]')";
					
					// 3: Base class exist and it must be udpate
					else
						$k = "update ActorsInheritance set base = '$data[3]' where derivative = '$data[1]'";

				}
			}
			break;

		case('derivativeDelete'):
			$k = "delete from ActorInheritance where base = '$data[0]' and derivative '$data[1]'";
			break;

		case('usecaseDelete'):
			$k = "delete from ActorUsecases where actor = '$data[0]' and usecase = '$data[1]'";
			break;

		case('usecaseCombine'):
			$k = "insert into ActorUsecases values ('$data[0]', '$data[1]')";
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