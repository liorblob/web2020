
$(function() {
    function ratingEnable() {
        $('#example-1to10').barrating('show', {
            theme: 'bars-1to10'
        });


    }

    ratingEnable();
});


function rateClick(b) {
    $("#ratingValue").val(b.value);
    $(".backdrop").fadeTo(200, 1);
}



function viewRatings() {
    ratingValue = $("#ratingValue").val();
    window.open("contentRatings.php?id="+ratingValue);
}


