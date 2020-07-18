function validateForm() {
    var nonletters = /[\ \-\*\+\!\@\#\$\%\^\(\)\[\]\{\}\,\.\<\>\?\=\_\;\|\/\\\~\`]/;
    var fname=document.forms["fedform"]["firstname"].value;
    var lname=document.forms["fedform"]["lastname"].value;
    var uname=document.forms["fedform"]["username"].value;
    
    if(fname.match(nonletters)){
        alert("השם הפרטי שהוזן אינו תקין");
        return false; 
    }
    if(lname.match(nonletters)){
        alert("שם המשפחה שהוזן אינו תקין");
        return false; 
    }
}
