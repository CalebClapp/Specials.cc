<?php

  date_default_timezone_set('America/Los_Angeles');
  $json = json_decode(file_get_contents('deals.json'));
  $today = date('l');
  $day_prefix = strtolower(substr($today,0,3));
  $now = strtotime(strftime('%T'));

?>