$(document).ready(function() { 
  $("#current-deals").tablesorter( {sortList: [[2,0]]} )
  .tablesorterPager({container: $(".pager")});
}); 