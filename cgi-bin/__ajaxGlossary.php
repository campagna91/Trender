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
			$data[0] = mysqli_real_escape_string($link, $data[0]);
			$data[1] = mysqli_real_escape_string($link, $data[1]);
			$k = "insert into Glossary values ('$data[0]', '$data[1]')";
			break;
		
		case('update'):
			$data[0] = mysqli_real_escape_string($link, $data[0]);
			$data[1] = mysqli_real_escape_string($link, $data[1]);
			$data[2] = mysqli_real_escape_string($link, $data[2]);
			$fix_mysql_error = mysqli_query($link, "delete from Glossary where term = '$data[0]'") or die("Error during deletion");
			$k = "insert into Glossary values ('$data[1]', '$data[2]')";
			break;

		case('delete'):
			$data[0] = mysqli_real_escape_string($link, $data[0]);
			$k = "delete from Glossary where term = '$data[0]'";
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

?>