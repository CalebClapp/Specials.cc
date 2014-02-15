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
  <div class="container">
    <header class="page-header">
      <h1 class="tac"><?php echo $today; ?> Deals</h1>
    </header>
    <div class="deals active">
      <h2 class="tac">Specials Happening Right Now</h2>
      <?php 
        $html = "<table class=\"tablesorter m0a\"><thead><tr><th>Place</th>
        <th>Special</th><th>Price</th><th>Expires</th></tr></thead><tbody>";
        foreach($json as $place => $specials) {
          foreach($specials as $special => $meta) {
            $start = new DateTime($meta->start, $timezone);
            $end = new DateTime($meta->end, $timezone);
            if (in_array($day_prefix, $meta->valid) &&
                ($now >= $start) &&
                  ($now <= $end)) {
              if(!isset($has_deals)) { $has_deals = true; }
              $html.="<tr>".render_entry($place,"td","entry-place").render_entry($special,"td","entry-special"); 
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
        <div class="pager-controls">
          <img src="http://mottie.github.com/tablesorter/addons/pager/icons/first.png" class="first"/> 
          <img src="http://mottie.github.com/tablesorter/addons/pager/icons/prev.png" class="prev"/> 
          <span class="pagedisplay"></span> <!-- this can be any element, including an input --> 
          <img src="http://mottie.github.com/tablesorter/addons/pager/icons/next.png" class="next"/> 
          <img src="http://mottie.github.com/tablesorter/addons/pager/icons/last.png" class="last"/>
        </div>
        <div class="pager-options">
          <span>Show: </span>
          <select class="pagesize" title="Deals to show"> 
            <option selected="selected" value="5">5</option> 
            <option value="10">10</option> 
            <option value="20">20</option>  
          </select>  
          <span>Jump to: </span>
          <select class="gotoPage" title="Select page number"></select>
        </div>
      </div>
    </div> <!-- end of deals block -->
    <footer class="page-footer">
      <p>Footer here</p>
    </footer>
  </div>
</div>
</body>
</html>