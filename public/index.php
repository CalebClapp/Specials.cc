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
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" >
</head>
<body>
<div class="wrapper">
  <div class="container">
    <a class="fork-me" href="https://github.com/ryananthony/Specials.cc/fork"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://github-camo.global.ssl.fastly.net/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
    <header class="page-header">
      <h1 class="tac"><?php echo $GLOBALS["today"]; ?> Specials</h1>
    </header>
    
    <?php 
      $active = render_specials($GLOBALS["lunch"], "active");
      $soon = render_specials($GLOBALS["lunch"], "soon");
      $done = render_specials($GLOBALS["lunch"], "done");

      if (!$active && !$soon && !$done) { ?>
        <h1 class="tac alert">No Specials right now, check back later.</h1>
      <?php } else {
        echo $active.$soon.$done;
      }
    ?>

    <footer class="page-footer">
      <div class="cf">
        <div class="tri-fold">
          <h3>More Bham Stuff</h3>
          <ul>
            <li><a href="http://www.cob.org/">City of Bellingham</a></li>
            <li><a href="http://www.bellinghamherald.com/">Bellingham Herald</a></li>
            <li><a href="http://www.whatsup-magazine.com/">What's Up Magazine</a></li>
            <li><a href="http://bellingham.craigslist.org/">Local Craigslist</a></li>
            <li><a href="http://www.fandango.com/bellingham_wa_movietimes">Movie Showtimes</a></li>
          </ul>
        </div>
        <div class="tri-fold">
          <h3>Missing a Special?</h3>
          <p><a href="mailto:ryananthonyrichardson@gmail.com">Email me</a> and I'll add it on the next code-push. Please <a href="https://github.com/ryananthony/Specials.cc/blob/master/lunch.json">check here first</a> to be sure it's not already included.</p>
        </div>
        <div class="tri-fold">
          <h3>Want to Contribute?</h3>
          <p>If you use Github, <a href="https://github.com/ryananthony/Specials.cc/fork">you can fork this repository</a>. Once you've made some changes, <a href="https://help.github.com/articles/creating-a-pull-request">submit a pull request</a> and I'll review it asap.</p>
        </div>
      </div>
      <div class="legal">
        <p>&copy;2014 <a href="http://www.ryananthonyrichardson.com/">Ryan Anthony Richardson</a>,
          <br>the bass player in that 90's band <a href="http://www.rockingflannel.com/">Flannel</a>.</p>
      </div>
    </footer>
  </div>
</div>
</body>
</html>