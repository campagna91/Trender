<? 
session_start(); 
require_once('./cgi-bin/__module.php');
?>

<html>
	<head>
		<link rel="stylesheet" href="css/__moduleHeader.css">
		<link rel="stylesheet" href="css/__moduleSidebar.css">
  		<link rel="stylesheet" href="css/__moduleSystem.css">
		<link rel="stylesheet" href="css/classi.css">
		<link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,500italic' rel='stylesheet' type='text/css'>
		<title>Classi</title>
		<meta charset="UTF-8">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/__event.js"></script>
	</head>
	<body><?
			if(!isset($_SESSION['user'])) { ?> <script>location.href="index.php";</script><?}
			modHeader();
			sideBar();
			mainList();?>
	</body>
</html>

