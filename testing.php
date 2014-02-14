<?php
  function test_equal($desc,$test) {
    $result = "fail";
    if($test[0] == $test[1]) {
      $result = "pass";
    }
    return $desc . "-> " . $result;
  }
?>