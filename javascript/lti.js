$(document).ready(function() {

    $("#exitButton").click(function() {
        $(".backdrop").fadeOut(200);
    });
  });

function downloadClick(b) {
    var value = b.value; 
    window.location.href = "contentDownloadMoodle.php?id=" + value;
}

function rateClick(b) {
  $("#ratingValue").val(b.value);
  $(".backdrop").fadeTo(200, 1);
}