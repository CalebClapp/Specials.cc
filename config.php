<?php
  $GLOBALS["debug"] = false;
  $GLOBALS["today"] = date('l');
  $GLOBALS["today_prefix"] = strtolower(substr($GLOBALS["today"],0,3));
  $GLOBALS["timezone"] = new DateTimezone('America/Los_Angeles');
  $GLOBALS["now"] = new DateTime('now', $GLOBALS["timezone"]);
  $GLOBALS["lunch"] = json_decode(file_get_contents('../lunch.json')); 
  if($GLOBALS["debug"]) { 
    //$GLOBALS["now"] = new DateTime('12:00:00', $timezone); // most if not all of the specials have begun
    $GLOBALS["now"] = new DateTime('10:45:00', $timezone); // some specials have begun
    //$GLOBALS["now"] = new DateTime('15:15:00', $timezone); // some specials have ended
    //$GLOBALS["now"] = new DateTime('19:15:00', $timezone); // most if not all specials have ended
  }  
?>