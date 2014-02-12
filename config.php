<?php

  $json = json_decode(file_get_contents('deals.json'));
  date_default_timezone_set('America/Los_Angeles');
  $today = date('l');

?>