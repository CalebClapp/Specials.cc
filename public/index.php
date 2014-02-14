<?php 
  include_once('../config.php');
  include_once('../functions.php');  
?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bellingham Specials for <?php echo $today; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js/vendor/jquery-1.11.0.min.js"></script>
  <script src="js/vendor/modernizr-2.7.1.min.js"></script>
  <script src="js/vendor/jquery.tablesorter.min.js"></script>
  <script src="js/vendor/jquery.tablesorter.pager.js"></script>
  <script src="js/main.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="wrapper">
  <div class="container m0a">
    <header class="page-header">
      <h1 class="tac">Bellingham Specials for <?php echo $today; ?></h1>
    </header>
      <?php 
        $html = "<table id=\"current-deals\" class=\"entries tablesorter m0a\"><thead><tr><th>Restaurant</th>
        <th>Lunch Special</th><th>Price</th><th>Expires</th></tr></thead><tbody>";

        foreach($json as $restaurant => $dishes) {
          foreach($dishes as $dish => $meta) {
            $start = new DateTime($meta->start);
            $end = new DateTime($meta->end);

            if($debug) {
              $now=(strtotime($meta->start) + (strtotime($meta->end) - strtotime($meta->start)) / 2);
            }

            if (in_array($day_prefix, $meta->valid) &&
                ($now >= strtotime($meta->start)) &&
                  ($now <= strtotime($meta->end))) {
              $html.="<tr>".render_entry($restaurant,"td","entry-restaurant").render_entry($dish,"td","entry-dish"); 
                $meta_keys=array('price','note');

                foreach($meta as $key => $value) { 
                  if(in_array($key, $meta_keys)) {
                    $html.=render_entry($value,"td","entry-".$key);
                  } 
                  if($key == 'end') {
                    $html.=render_entry(date("H:i:s", (strtotime($value) - $now)),"td","entry-".$key);
                  }  
                } 
              $html.="</tr>";
            } 
          }
        } 
        $html.="</tbody></table>";
        echo $html;

        ?>
  </div>
</div>

</body>
</html>