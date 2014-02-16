<?php
  $debug = true;
  $json = json_decode(file_get_contents('../deals.json')); 
  $today = date('l');
  $day_prefix = strtolower(substr($today,0,3));
  $timezone = new DateTimezone('America/Los_Angeles');
  if($debug) {
    $now = new DateTime('12:00:00', $timezone);
  } else {
    $now = new DateTime('now', $timezone);
  }
?>