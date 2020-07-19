function setCookie(cname, cvalue) {
  var d = new Date();
  d.setTime(d.getTime() + (7 * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  if(cvalue !== ""){
    window.location.href = "includes/home.php";
  }
  else {
    window.location.href = "../index.php"
  }
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkUserCookie() {
  var cookie = getCookie("user");
  if(cookie) {
    user = cookie.split(",");
    $.post("includes/cookieLogin.php",
    {
      id: user[0],
      name: user[1]
    }, function(data, status){
      window.location.href = "includes/home.php";
    });
  }
}