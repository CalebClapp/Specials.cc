$(document).ready(function() { 
  $(".specials.active table").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({
    container: $(".pager-active"),
    size: 5
  });
  $(".specials.soon table").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({
    container: $(".pager-soon"),
    size: 5
  });
  $(".specials.done table").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({
    container: $(".pager-done"),
    size: 5
  });
}); 