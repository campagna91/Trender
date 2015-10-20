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

	switch($typeRequest)
	{
		case('insert'):
			if(!esiste($data[0]))
			{
				$data[1] = mysqli_real_escape_string($link, $data[1]);
				$k = "insert into Verbals values('$data[0]', '$data[1]') ";
			}
			break;

		case('update'):
			if(!esiste($data[1]))
			{
				$data[1] = mysqli_real_escape_string($link, $data[1]);
				$k = "UPDATE Verbali set stesura = '$data[1]' where data = CAST('$data[0]' AS DATE)";
			}
			break;

		case('delete'):
			$k = "delete from Verbals where date = '$data[0]'";			
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