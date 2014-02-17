<?php

  // render_tag(string,tag,class)
  // wraps string in table-data (or other HTML tag) with optional class-name
  function render_tag($string="",$tag="td",$class="") {
    $entry = "<".$tag;
    if($class != "") {
      $entry .= " class=\"".$class."\"";
    }
    return $entry .= ">".$string."</".$tag.">";
  }

  // takes a string of the classes for the table and 
  // arbitrary number of <th> text nodes
  // returns string of "<table> -> <tbody>"
  function render_specials_hdr($classes) {
    $headings = array_slice(func_get_args(), 1);
    $header = "<table class=\"".$classes."\"><thead><tr>";
    for($i=0;$i<count($headings);$i++) { $header.="<th>".$headings[$i]."</th>"; }
    $header.="</tr></thead><tbody>"; 
    return $header;
  }

  // takes a JSON "special" meta object, place and item... also optional timezone
  // returns a string representation of (this) "special" as HTML table row
  function render_special($meta, $place, $special) {
    $body = "";
    $start = new DateTime($meta->start, $GLOBALS["timezone"]);
    $end = new DateTime($meta->end, $GLOBALS["timezone"]);
    if (in_array($GLOBALS["today_prefix"], $meta->valid) &&
        ($GLOBALS["now"] >= $start) &&
          ($GLOBALS["now"] <= $end)) {
      $body.="<tr>".render_tag($place,"td","entry-place").render_tag($special,"td","entry-special"); 
      foreach($meta as $key => $value) { 
        if($key == "price") {
          $body.=render_tag($value,"td","entry-".$key);
        } 
        else if($key == "end") {
          $body.=render_tag( time_remaining($end) ,"td","entry-".$key);
        }
      } 
      return $body.="</tr>";
    } else {
      return "";
    }
  }

  // takes top-level JSON object and type of specials block (active,soon,done)
  // returns false if no matching specials, otherwise a specials HTML div as a string
  function render_specials($json, $type) {
    $specials_block = "<div class=\"specials ".$type."\">";
    $table_head = render_specials_hdr('tablesorter','Place','Special','Price','Ends');
    $table_body = "";
    foreach($json as $place => $specials) {
      foreach($specials as $special => $meta) {
        $table_body .= render_special($meta,$place,$special);
      }
    }
    if($table_body == "") {
      return false;
    } else {
      return $specials_block.=$table_head.$table_body."</tbody></table></div>";
    }

  }

  // $until is a DateTime object
  // returns string of remaining time from $base to $end
  function time_remaining($until) {
    $remaining = $GLOBALS["now"]->diff($until);
    return $remaining->format('%h:%I:%S');
  }

?>