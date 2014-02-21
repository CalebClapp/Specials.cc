<?php
  $GLOBALS["debug"] = false;
  $GLOBALS["timezone"] = new DateTimezone('America/Los_Angeles');
  $GLOBALS["now"] = new DateTime('now', $GLOBALS["timezone"]);
  $GLOBALS["today"] = $GLOBALS["now"]->format('l');
  $GLOBALS["today_prefix"] = strtolower(substr($GLOBALS["today"],0,3));
  $GLOBALS["lunch"] = json_decode(file_get_contents('../lunch.json')); 
  if($GLOBALS["debug"]) { 
    //$GLOBALS["now"] = new DateTime('05:00:00', $timezone); // no specials recently ended, upcoming or current
    //$GLOBALS["now"] = new DateTime('10:00:00', $timezone); // zero specials have begun
    //$GLOBALS["now"] = new DateTime('12:00:00', $timezone); // most if not all of the specials have begun
    $GLOBALS["now"] = new DateTime('10:45:00', $timezone); // some specials have begun
    //$GLOBALS["now"] = new DateTime('16:15:00', $timezone); // most specials have ended
    //$GLOBALS["now"] = new DateTime('22:00:00', $timezone); // all specials have ended
  }  
?>