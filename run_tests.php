<?php

  require_once("testing.php");
  require_once("functions.php");

  echo test_equal("render_entry() with only string",array(render_entry("Test"),"<td>Test</td>"));
  echo "\n";
  echo test_equal("render_entry() with string and p tag",array(render_entry("Test","p"),"<p>Test</p>"));
  echo "\n";
  echo test_equal("render_entry() with string, tag and class",array(render_entry("Test","p","sexier"),"<p class=\"sexier\">Test</p>"));
  echo "\n";

?>