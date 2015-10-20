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
		case('insert');
			$data[1] = mysqli_real_escape_string($link,$data[1]);
			$data[2] = mysqli_real_escape_string($link,$data[2]);
			$data[3] = mysqli_real_escape_string($link,$data[3]);
			if(!esiste($data[1], $data[0]))		
				$k = "insert into Classes(package, class, description, applications) values ('$data[0]', '$data[1]', '$data[2]', '$data[3]')";
			break;
		
		case('delete'):
			$k = "delete from Classes where class = '$data[0]' and package = '$data[1]'";
			break;
			
		case('update'): 
			$data[2] = mysqli_real_escape_string($link,$data[2]);
			$data[3] = mysqli_real_escape_string($link,$data[3]);
			$data[4] = mysqli_real_escape_string($link,$data[4]);
			if( (($data[0] != $data[1]) && !esiste($data[1], $data[2])) || $data[1] == $data[0])
				$k = "update Classes set class = '$data[1]', description = '$data[3]', applications = '$data[4]', package = '$data[2]' where class = '$data[0]'";
			break;

		case('baseInsert'):
			$k = "insert into ClassInheritance values ('$data[1]', '$data[0]', '$data[2]', '$data[3]')";
			break;

		case('baseDelete'):
			$k = "delete from ClassInheritance where base = '$data[1]' and derivative = '$data[0]' and basePackage = '$data[3]' and derivativePackage = '$data[2]'";
			break;

		case('relationInsert'):
			$k = "insert into ClassRelations values ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]')";
			break;

		case('relationDelete'):
			$k = "delete from ClassRelations where classStart = '$data[0]' and packageStart = '$data[1]' and classEnd = '$data[2]' and packageEnd = '$data[3]' and relation = '$data[4]'";
			break;

		case('attributeInsert'):
			$k = "insert into ClassAttributes values ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]')";
			break;

		case('attributeUpdate'):
			$k = "update ClassAttributes set attribute = '$data[4]', type ='$data[3]', description = '$data[5]' where attribute = '$data[2]' and class = '$data[0]' and package = '$data[1]'";
			break;

		case('attributeDelete'):
			$k = "delete from ClassAttributes where class ='$data[0]' and package ='$data[1]' and attribute = '$data[2]'";
			break;

		case('methodInsert'):
			$k = "insert into ClassMethods values ('$data[0]', '$data[3]', '$data[2]', '$data[4]', '$data[1]')";
			break;

		case('paramInsert'):
			$k = "insert into ClassMethodsParams values ('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]')";
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