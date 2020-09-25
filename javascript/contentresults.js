function downloadClick(b) {

    var value = b.value; 
    window.location.href = "contentDownload.php?id=" + value;
  
  }

function rateClick(b) {
    $("#ratingValue").val(b.value);
    $(".backdrop").fadeTo(200, 1);
}



function viewRatings() {
    ratingValue = $("#ratingValue").val();
    window.open("contentRatings.php?id="+ratingValue);
}


