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


  $(".specials tr").click(function() {
    if(!$(this).data("added") &&
      typeof $(this).data("address") !== "undefined") {
      var address = $(this).data("address");
      var phone = $(this).data("phone");
      $(this).data({"added":true});
      $(this).after("<tr class=\"special-meta\"><td colspan=\"4\"><strong>Address:</strong> " + address + " <strong>Phone:</strong> " + phone + "</td></tr>");
    } else {
      $(".special-meta").remove();
      $(this).data({"added":false});
    }
  });

}); 