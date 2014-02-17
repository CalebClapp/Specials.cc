<?php

  require_once("testing.php");
  require_once("functions.php");

  $place = "Good Foods R Us";
  $special = "Yummy Dish";
  $meta = {      
    "price": "6.95",
    "valid": ["mon","tue","wed","thu","fri","sat","sun"],
    "start": "00:00:00",
    "end": "23:59:59",
    "note": null
  }

  echo test_equal("render_tag() with only string",array(render_tag("Test"),"<td>Test</td>"));
  echo "\n";
  echo test_equal("render_tag() with string and p tag",array(render_tag("Test","p"),"<p>Test</p>"));
  echo "\n";
  echo test_equal("render_tag() with string, tag and class",array(render_tag("Test","p","sexier"),"<p class=\"sexier\">Test</p>"));
  echo "\n";

?>