<? session_start(); 
require_once('cgi-bin/__module.php'); ?>
<html>
	<head>
		<title>Settings</title>
		<!--Import Google Icon Font-->
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="lib/materialize/css/materialize.min.css"/>
		<link type="text/css" rel="stylesheet" href="css/settings.css"/>
		<link type="text/css" rel="stylesheet" href="css/system.css"/>
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<!-- Libraries import -->
		<script type="text/javascript" src="lib/jQuery/jQuery1.11.1.js"></script>
		<script type="text/javascript" src="lib/materialize/js/materialize.js"></script>
		<!--Import Google Icon Font-->		
		<link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,500italic' rel='stylesheet' type='text/css'>
		<meta charset="UTF-8">
		<!-- Events handler -->
		<script type="text/javascript" src="js/events/__event.js"></script>
	</head>
	<body> 
		<?
			// Menu
			modHeader();

			// Check if useer is logged
			logged();
		?>
			<div class="row">
				<div class="col s4">
					<? include_once 'cgi-bin/__moduleSettingMenu.php'; ?>
				</div>
				<div id="setting-content" class="col s8 blue-grey">
					<?
						if(isset($_GET['part'])) {
							switch($_GET['part']) {
								case('types'):
									include_once 'cgi-bin/__moduleSettingTypes.php';
									break;

								case('users'):
									include_once 'cgi-bin/__moduleSettingUsers.php';
									break;

								default:
									include_once 'cgi-bin/__moduleSettingSources.php';
							}
						} else 
							include_once 'cgi-bin/__moduleSettingSources.php';
					?>
				</div>
			</div>
	</body>
</html>

