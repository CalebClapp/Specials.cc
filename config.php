<?php
  $GLOBALS["debug"] = false;
  $GLOBALS["today"] = date('l');
  $GLOBALS["today_prefix"] = strtolower(substr($GLOBALS["today"],0,3));
  $GLOBALS["timezone"] = new DateTimezone('America/Los_Angeles');
  $GLOBALS["now"] = new DateTime('now', $GLOBALS["timezone"]);
  $GLOBALS["specials"] = json_decode(file_get_contents('../specials.json')); 
  if($GLOBALS["debug"]) { $GLOBALS["now"] = new DateTime('12:00:00', $timezone); } 
?>