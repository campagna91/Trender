<? 
session_start(); 
require_once('./cgi-bin/__module.php');
?>

<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="css/__moduleHeader.css">
		<link rel="stylesheet" href="css/__moduleSidebar.css">
  	<link rel="stylesheet" href="css/__moduleSystem.css">
		<link rel="stylesheet" href="css/unitTest.css">
		<link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,500italic' rel='stylesheet' type='text/css'>
		<title>Test di unit&agrave</title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/__event.js"></script>
	</head>
	<body><?
			if(!isset($_SESSION['user'])) { ?> <script>location.href="index.php";</script><?}
			modHeader();

			mainList();?>
	</body>
	
</html>

