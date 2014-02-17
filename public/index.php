<?php 
  include_once('../config.php');
  include_once('../functions.php');  
?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bellingham Specials for <?php echo $GLOBALS["today"]; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js/vendor/jquery-1.11.0.min.js"></script>
  <script src="js/vendor/jquery-migrate-1.2.1.min.js"></script>
  <script src="js/vendor/modernizr-2.7.1.min.js"></script>
  <script src="js/vendor/jquery.tablesorter.min.js"></script>
  <script src="js/vendor/jquery.tablesorter.pager.js"></script>
  <script src="js/main.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="wrapper">
  <div class="container">
    <a class="fork-me" href="https://github.com/ryananthony/Specials.cc"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://github-camo.global.ssl.fastly.net/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
    <header class="page-header">
      <h1 class="tac"><?php echo $GLOBALS["today"]; ?> Specials</h1>
    </header>
    
    <?php 
      echo render_specials($GLOBALS["lunch"], "active");
      include_once("tablesorter_pager.php");
    ?>

    <footer class="page-footer">
      <div class="cf">
        <div class="tri-fold">
          <h3>Coming Soon</h3>
          <h3></h3>
          <p>left</p>
        </div>
        <div class="tri-fold">
          <h3>Coming Soon</h3>
          <p>mid</p>
        </div>
        <div class="tri-fold">
          <h3>Coming Soon</h3>
          <p>right</p>
        </div>
      </div>
      <div class="legal">
        <p>&copy;2014 <a href="http://www.ryananthonyrichardson.com/">Ryan Anthony Richardson</a>, the bass player in that 90's band <a href="http://www.rockingflannel.com/">Flannel</a>.</p>
      </div>
    </footer>
  </div>
</div>
</body>
</html>