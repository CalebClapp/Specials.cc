<?php include('config.php'); ?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bellingham Specials for <?php echo $today; ?></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href='http://fonts.googleapis.com/css?family=Architects+Daughter' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/main.css">
  <script src="js/vendor/modernizr-2.7.1.min.js"></script>
</head>
<body>
<div class="wrapper">
  <div class="container m0a">
    <header class="page-header">
      <h1 class="tac">Bellingham Specials for <?php echo $today; ?></h1>
    </header>
      <?php 
      $html = "<table class=\"entries m0a\">\n<tr>\n<th>Restaurant</th>\n
        <th>Lunch Special</th>\n<th>Price</th>\n<th>Expires</th>\n</tr>";
        foreach($json as $restaurant => $dishes) {
          foreach($dishes as $dish => $meta) {
            $start = new DateTime($meta->start);
            $end = new DateTime($meta->end);
            if (in_array($day_prefix, $meta->valid) &&
               ($now >= strtotime($meta->start)) /*&&
               ($now <= strtotime($meta->end))*/) { 
                echo $html; ?>

              <tr>
                <td class="entry-restaurant">
                  <?php echo $restaurant; ?>
                </td>
                <td class="entry-dish">
                  <?php echo $dish; ?>
                </td>
              <?php 
                $meta_keys = ['price','note'];
                foreach($meta as $key => $value) { 
                  if(in_array($key, $meta_keys)) { ?>
                    <td class="entry-<?php echo $key; ?>">
                      <?php echo $value; ?>
                    </td> <?php 
                  } 
                  if($key == 'end') { ?>
                    <td class="entry-<?php echo $key; ?>">
                      <?php echo date("H:i:s", (strtotime($value) - $now)); ?>
                    </td> <?php 
                  }  
                } ?>
              </tr> <?php 
            } else { ?>
              <h2 class="tac">No Deals Happening Right Now, Check Back Later.</h2> <?php 
              break 2;
            }
          }
        } ?>
    </table>  
  </div>
</div>

</body>
</html>