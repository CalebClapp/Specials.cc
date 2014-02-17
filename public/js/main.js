$(document).ready(function() { 
  $(".specials table").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({
    container: $(".pager"),
    size: 5
  });
}); 