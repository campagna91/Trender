<? 
session_start(); 
require_once('./cgi-bin/__module.php');
?>
<html>
  <head>
    
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="lib/materialize/css/materialize.min.css"/>
    <link type="text/css" rel="stylesheet" href="css/system.css"/>
    
    <!--Let browser know website is optimized for mobile-->
    <script type="text/javascript" src="lib/jQuery/jQuery1.11.1.js"></script>
    <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/index.css">
    <link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,500italic' rel='stylesheet' type='text/css'>
    <title>Home</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="js/events/__event.js"></script>
  </head>
  <body>
    <?
      logout();
      if(isset($_SESSION['user']) && $_SESSION['user'] != "")
        modHeader();
      elseif(isset($_POST['utente']) && login($_POST['utente'],$_POST['password'])) {
        $_SESSION['user'] = $_POST['utente'];
        modHeader();
      } else
        modLogin(); 
    ?>
</body>
</html>