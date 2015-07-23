<? 
session_start(); 
require_once('./cgi-bin/__module.php');
?>
<html>
  <head>
    <link rel="stylesheet" href="css/__moduleSystem.css">
    <link rel="stylesheet" href="css/__moduleHeader.css">
    <link rel="stylesheet" href="css/__moduleLogin.css">
    <link rel="stylesheet" href="css/index.css">
    <link href='http://fonts.googleapis.com/css?family=Calligraffitti' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Alegreya+Sans:400,500italic' rel='stylesheet' type='text/css'>
    <title>Requisiti</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/__event.js"></script>
  </head>
  <body><?
    logout();
    if(isset($_SESSION['user']) and $_SESSION['user']!= "")
    {
      include('./cgi-bin/__moduleHeader.php');
      modIndexResume(); 
    } else {
      if(isset($_POST['loginButton']) )
      {
        if(login($_POST['utente'],$_POST['password']))
        {
          $_SESSION['user']=$_POST['utente'];
          modHeader();
          modIndexResume();
        } else
            modLogin();
      } else 
        modLogin();
    } ?>
</body>
</html>