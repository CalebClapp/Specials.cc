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


  // takes top-level JSON object and type of specials block (active,soon,done)
  // returns false if no matching specials, otherwise a specials HTML div as a string
  function render_specials($json, $type) {
    $specials_block = "<div class=\"specials ".$type."\">";
    $table_body = "";
    switch ($type) {
      case "soon":
        $h2 = "<h2>Starting Soon</h2>";
        $table_head = render_specials_hdr('tablesorter','Place','Special','Price','Begins');
        foreach($json as $place => $specials) {
          foreach($specials as $special => $meta) {
            $start = new DateTime($meta->start, $GLOBALS["timezone"]);
            $end = new DateTime($meta->end, $GLOBALS["timezone"]);
            if (in_array($GLOBALS["today_prefix"], $meta->valid) &&
                  ($GLOBALS["now"] <= $start)) {
              $table_body .= "<tr>".render_tag($place,"td","entry-place").render_tag($special,"td","entry-special");
              foreach($meta as $key => $value) { 
                if($key == "price") {
                  $table_body.=render_tag($value,"td","entry-".$key);
                } 
                else if($key == "end") {
                  $table_body.=render_tag( time_diff($start) ,"td","entry-".$key);
                }
              }
              $table_body.="</tr>";
            }
          }
        }
        break;
      case "done":
        $h2 = "<h2>Recently Ended</h2>";
        $table_head = render_specials_hdr('tablesorter','Place','Special','Price','Ended');
        foreach($json as $place => $specials) {
          foreach($specials as $special => $meta) {
            $start = new DateTime($meta->start, $GLOBALS["timezone"]);
            $end = new DateTime($meta->end, $GLOBALS["timezone"]);
            if (in_array($GLOBALS["today_prefix"], $meta->valid) &&
                ($GLOBALS["now"] >= $end)) {
              $table_body .= "<tr>".render_tag($place,"td","entry-place").render_tag($special,"td","entry-special");
              foreach($meta as $key => $value) { 
                if($key == "price") {
                  $table_body.=render_tag($value,"td","entry-".$key);
                } 
                else if($key == "end") {
                  $table_body.=render_tag( time_diff($end) ,"td","entry-".$key);
                }
              }
              $table_body.="</tr>";
            }
          }
        }
        break;
      default:
        $h2 = "<h2>Happening Now</h2>";
        $table_head = render_specials_hdr('tablesorter','Place','Special','Price','Ends');
        foreach($json as $place => $specials) {
          foreach($specials as $special => $meta) {
            $start = new DateTime($meta->start, $GLOBALS["timezone"]);
            $end = new DateTime($meta->end, $GLOBALS["timezone"]);
            if (in_array($GLOBALS["today_prefix"], $meta->valid) &&
                ($GLOBALS["now"] >= $start) &&
                  ($GLOBALS["now"] <= $end)) {
              $table_body .= "<tr>".render_tag($place,"td","entry-place").render_tag($special,"td","entry-special");
              foreach($meta as $key => $value) { 
                if($key == "price") {
                  $table_body.=render_tag($value,"td","entry-".$key);
                } 
                else if($key == "end") {
                  $table_body.=render_tag( time_diff($end) ,"td","entry-".$key);
                }
              }
              $table_body.="</tr>";
            }
          }
        }
        break;
    }
    if($table_body == "") {
      return false;
    } else {
      return $specials_block.=$h2.$table_head.$table_body."</tbody></table>".render_pager($type)."</div>";
    }
  }

  function render_pager($type) {
    $pager = "<div class=\"pager-".$type."\"> 
      <div class=\"pager-controls cf\">
        <div class=\"first\">
          <span>first</span>
        </div>
        <div class=\"prev\"></div>
        <div class=\"next\"></div>
        <div class=\"last\">
          <span>last</span>
        </div>
      </div>
      <div class=\"pager-options\">
        <span class=\"pagedisplay\"></span>
        <span>Show: </span>
        <select class=\"pagesize\" title=\"Deals to show\"> 
          <option selected=\"selected\" value=\"5\">5</option> 
          <option value=\"10\">10</option> 
        </select>  
        <span>Jump to: </span>
        <select class=\"gotoPage\" title=\"Select page number\"></select>
      </div>
    </div>";
    return $pager;
  }

  // $time_constant is a DateTime object
  // returns string of remaining time from $base to $end
  function time_diff($time_constant) {
    $until = $GLOBALS["now"]->diff($time_constant);
    return $until->format('%h:%I:%S');
  }

?>