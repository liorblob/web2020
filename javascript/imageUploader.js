$("#imageUpload").on('change', function () {
  
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    var image_holder = $("#image-holder");
    image_holder.empty();
    
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
        if (typeof (FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("<img />", {
                    "src": e.target.result,
                        "class": "thumb-image"
                }).appendTo(image_holder);
            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
    
        } else {
            alert("FileReader-דפדפן זה אינו תומך ב");
        }
    } else {
        $(this)[0].value = null;
        alert("בבקשה העלה קובץ תמונה בלבד");
    }
    });
