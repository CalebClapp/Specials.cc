$(document).ready(function() { 
  $(".deals table").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({
    container: $(".pager"),
    size: 5,
    fixedHeight: true
  });
}); 