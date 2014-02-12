<?php include('config.php'); ?>
<!doctype html>
<html>
<head>
  <title><?php echo $today; ?> Food Deals</title>
</head>
<body>

<table>
  <th>
    <?php echo $today; ?> Deals
  </th>
                                                <?php 
                                                  foreach($json as $day => $entries) {
                                                    if($day == strtolower($today)) {
                                                      foreach($entries as $restaurant => $meta) { ?>
    <tr>
      <td class="entry-restaurant">
        <?php echo $restaurant; ?>
      </td>
                                                      <?php 
                                                        foreach($meta as $key => $value) { ?>
      <td class="entry-<?php echo $key; ?>">
        <?php echo $value; ?>
      </td>
                                                      <?php } ?>
    </tr>
                                                    <?php }
                                                        }
                                                      } 
                                                    ?>
</table>
</body>
</html>