
$(function() {
    function ratingEnable() {
        $('#example-1to10').barrating('show', {
            theme: 'bars-1to10'
        });


    }

    ratingEnable();
});

function downloadClick(b) {

    var value = b.value; 
    window.location.href = "contentDownload.php?id=" + value;
  
  }

function rateClick(b) {
    $("#ratingValue").val(b.value);
    $(".backdrop").fadeTo(200, 1);
}


