$("#contentInput").on('change', function () {
  
    var imgPath = $(this)[0].value;
    var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
    
    if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg" || 
    extn == "pdf" || extn == "ppt" || extn == "xls" || extn == "xlsx" || extn == "csv" || 
    extn == "doc" || extn == "docx" || extn == "pptx" || extn == "mp4" || 
    extn == "mp3" || extn == "avi" || extn == "wav" || extn == "mkv") {
        if (typeof (FileReader) != "undefined") {
            var reader = new FileReader();
            reader.readAsDataURL($(this)[0].files[0]);
    
        } else {
            alert("FileReader-דפדפן זה אינו תומך ב");
        }
    } else {
        $(this)[0].value = null;
        alert("סוג הקובץ אינו תקין. בבקשה אעלה חומרי לימוד בלבד");
    }
    });
