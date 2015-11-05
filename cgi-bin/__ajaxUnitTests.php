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
			$k = "insert into UnitTests values ($data[0], '$data[1]', 'notImplemented', 'notSatisfied')";
			break;

		case('delete'):
			$k = "delete from UnitTests where test = '$data[0]'";
			break;

		case('update'):
			$k = "update UnitTests set description = '$data[1]' where test = '$data[0]'";
			break;

		case('insertMethod'):
			$k = "insert into UnitTestClassesMethods values ($data[0], '$data[1]', '$data[3]', '$data[4]', '$data[2]')";
			break;

		case('methodDelete'):
			$k = "delete from UnitTestClassesMethods where test = $data[0] and returnType = '$data[1]' and package = '$data[2]' and class ='$data[3]' and signature = '$data[4]'";
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