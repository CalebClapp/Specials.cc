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

  // takes a string of the classes for the table and the type of special block
  // returns string of "<h2>+<table>-><tbody>"
  function render_specials_hdr($classes,$type) {
    $header = "<table class=\"".$classes."\"><thead><tr><th>Place</th><th>Special</th><th>Price</th><th>";
    switch ($type) {
      case "soon":
        $h2 = "<h2>Starting Soon</h2>";
        $header.="Begins";
        break;
      case "done":
        $h2 = "<h2>Recently Ended</h2>";
        $header.="Ended";
        break;
      default:
        $h2 = "<h2>Happening Now</h2>";
        $header.="Ends";
        break;
    }
    $header.="</th></tr></thead><tbody>"; 
    return $h2.$header;
  }

  // returns an HTML-formatted single special as a string
  function render_special($place,$special,$meta,$time,$address,$phone) {
    $special_row = "<tr data-phone=\"".$phone."\" data-address=\"".$address."\">".render_tag($place,"td","entry-place").render_tag($special,"td","entry-special");
    foreach($meta as $key => $value) { 
      if($key == "price") {
        $special_row.=render_tag($value,"td","entry-".$key);
      } 
      else if($key == "end") {
        $special_row.=render_tag( time_diff($time) ,"td","entry-clock");
      }
    }
    return $special_row.="</tr>";
  }

  // takes top-level JSON object and type of specials block (active,soon,done)
  // returns false if no matching specials, otherwise a specials HTML div as a string
  function render_specials($json, $type) {
    $table_body = "";
    $table_head = "";
    $special_count = 0;

    foreach($json as $place => $data) {
      $address = $data->address;
      $phone = $data->phone;
      $specials = $data->specials;
      foreach($specials as $special => $meta) {
        $start = new DateTime($meta->start, $GLOBALS["timezone"]);
        $end = new DateTime($meta->end, $GLOBALS["timezone"]);
        switch ($type) {
          case "soon":
            if (in_array($GLOBALS["today_prefix"], $meta->valid) &&
                  ($GLOBALS["now"] <= $start) &&
                  (time_diff($start) < 2)) {
              $table_body.=render_special($place,$special,$meta,$start,$address,$phone);
              $special_count++;
            }
            break;
          case "done":
            if (in_array($GLOBALS["today_prefix"], $meta->valid) &&
                ($GLOBALS["now"] >= $end) &&
                (time_diff($end) < 1)) {
              $table_body.=render_special($place,$special,$meta,$end,$address,$phone);
              $special_count++;
            }
            break;
          default:
            if (in_array($GLOBALS["today_prefix"], $meta->valid) &&
                ($GLOBALS["now"] >= $start) &&
                  ($GLOBALS["now"] <= $end)) {
              $table_body.=render_special($place,$special,$meta,$end,$address,$phone);
              $special_count++;
            }
            break;
        }
      }
    }
    if($table_body == "") {
      return false;
    } else {
      $table_body.="</tbody></table>";
      if ($special_count > 5) { //only show pager if there is more than 5 specials
        $table_body.=render_pager($type);
        $table_head = render_specials_hdr("tablesorter",$type);
      } else {
        $table_head = render_specials_hdr("",$type);
      }
      return "<div class=\"specials ".$type."\">".$table_head.$table_body."</div>";;
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
  // returns string of remaining time from "now" until given time
  function time_diff($time_constant) {
    $until = $GLOBALS["now"]->diff($time_constant);
    return $until->format('%h:%I:%S');
  }

?>