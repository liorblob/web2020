function validateForm() {
    var letters = /^[a-zA-Z\s]+$/;
    var fname=document.forms["fedform"]["firstname"].value;
    var lname=document.forms["fedform"]["lastname"].value;
    var school=document.forms["fedform"]["school"].value;
    
    if(!fname.match(letters)){
        alert("השם הפרטי שהוזן אינו תקין");
        return false; 
    }
    if(!lname.match(letters)){
        alert("שם המשפחה שהוזן אינו תקין");
        return false; 
    }
}
