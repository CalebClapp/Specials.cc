$(document).ready(function() { 
  $(".specials.active .tablesorter").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({
    container: $(".pager-active"),
    size: 5
  });
  $(".specials.soon .tablesorter").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({
    container: $(".pager-soon"),
    size: 5
  });
  $(".specials.done .tablesorter").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({
    container: $(".pager-done"),
    size: 5
  });
}); 