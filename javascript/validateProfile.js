function validateForm() {
    var nonletters = /[\ \-\*\+\!\#\$\%\^\(\)\[\]\{\}\,\<\>\?\=\;\|\/\\\~\`]/;
    

    var fname=document.forms["fedform"]["firstname"].value;
    var lname=document.forms["fedform"]["lastname"].value;
    var uname=document.forms["fedform"]["username"].value;
    var email=document.forms["fedform"]["email"].value;
    var school=document.forms["fedform"]["school"].value;
    
    if(email.match(nonletters)){
        alert("המייל שהוזן אינו תקין");
        return false; 
    }

    if(uname.match(nonletters)){
        alert("שם המשתמש שהוזן אינו תקין");
        return false; 
    }

    if(fname.match(nonletters)){
        alert("השם הפרטי שהוזן אינו תקין");
        return false; 
    }

    if(lname.match(nonletters)){
        alert("שם המשפחה שהוזן אינו תקין");
        return false; 
    }
}
