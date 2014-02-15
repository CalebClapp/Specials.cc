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
  <div class="container m0a">
    <header class="page-header">
      <h1 class="tac">Bellingham Specials for <?php echo $today; ?></h1>
    </header>
    <?php 
      $html = "<table id=\"current-deals\" class=\"entries tablesorter m0a\"><thead><tr><th>Restaurant</th>
      <th>Lunch Special</th><th>Price</th><th>Expires</th></tr></thead><tbody>";
      foreach($json as $restaurant => $dishes) {
        foreach($dishes as $dish => $meta) {
          $start = new DateTime($meta->start, $timezone);
          $end = new DateTime($meta->end, $timezone);
          if (in_array($day_prefix, $meta->valid) &&
              ($now >= $start) &&
                ($now <= $end)) {
            if(!isset($has_deals)) { $has_deals = true; }
            $html.="<tr>".render_entry($restaurant,"td","entry-restaurant").render_entry($dish,"td","entry-dish"); 
            foreach($meta as $key => $value) { 
              if($key == 'price') {
                $html.=render_entry($value,"td","entry-".$key);
              } 
              else if($key == 'end') {
                $remaining = $now->diff($end);
                $html.=render_entry( $remaining->format('%h:%I:%S') ,"td","entry-".$key);
              }

            } 
            $html.="</tr>";
          } 
        }
      } 
      if(isset($has_deals)) {
        $html.="</tbody></table>";
        echo $html;        
      } else { ?>
        <h2 class="tac">No deals happening now, check back later.</h2>
    <?php } ?>
    <!-- pager --> 
    <div class="pager"> 
            <img src="http://mottie.github.com/tablesorter/addons/pager/icons/first.png" class="first"/> 
            <img src="http://mottie.github.com/tablesorter/addons/pager/icons/prev.png" class="prev"/> 
            <span class="pagedisplay"></span> <!-- this can be any element, including an input --> 
            <img src="http://mottie.github.com/tablesorter/addons/pager/icons/next.png" class="next"/> 
            <img src="http://mottie.github.com/tablesorter/addons/pager/icons/last.png" class="last"/> 
            <select class="pagesize" title="Select page size"> 
                <option selected="selected" value="10">10</option> 
                <option value="20">20</option> 
                <option value="30">30</option> 
                <option value="40">40</option> 
            </select>  
            <select class="gotoPage" title="Select page number"></select>
    </div>
  </div>
</div>
</body>
</html>