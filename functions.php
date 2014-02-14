<?php

	// render_entry(string,tag,class)
	// wraps string in table-data (or other HTML tag) with optional class-name

	function render_entry($string="",$tag="td",$class="") {
    $entry = "<".$tag;

		if($class != "") {
      $entry .= " class=\"".$class."\"";
    }

    return $entry .= ">".$string."</".$tag.">";
	}

?>