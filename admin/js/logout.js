$(document).ready(function() {

  $('#btnthoat').click(function() {
    bootbox.confirm("Bạn thực sự muốn thoát?", function(result) {
      if (result==true){
        window.location.href = '../models/logout.php';
      }
    });
  });
  $('#btnlogout').click(function() {
    bootbox.confirm("Bạn thực sự muốn thoát?", function(result) {
      if (result==true){
        window.location.href = '../models/logout.php';
      }
    });
  });
});