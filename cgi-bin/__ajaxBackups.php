<? 
	require_once '__system.php';

	// Request type (insert, update, combine some entity, etc)
	$typeRequest = $_POST['typeRequest'];

	// Rappresent the type of selection need only if variable $typeRequest has a value == 'select
	$typeSelect;

	// Data passed for specific action
	if(isset($_POST['data']))
		$data = $_POST['data'];

	// Query to perform
	$k = "";

	// Database connection
	$link = connect();

	switch($typeRequest) {
		case('do'):
			$date = date('YmdHis');
			$command = "/Applications/XAMPP/bin/mysqldump --user=root Trender > ../backup/" . $date . ".sql";
			$aux = shell_exec($command);
			break;

		case('restore');
			$date = $data[0];
			$command = "/Applications/XAMPP/bin/mysql --user=root Trender < ../backup/" . $data . ".sql"; 
			$aux = shell_exec($command);
			break;			
	}
	
?>