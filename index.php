<?php
  // Hi
  include 'includes/dbconn.php';
  session_start();

  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
    header("location: includes/home.php");
    exit;
  }

  echo "<script type='text/javascript' src='javascript/cookies.js'></script>";
  echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";
  echo "<script type='text/javascript'>checkUserCookie()</script>";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
      $username = $_POST['username'];
      $password = $_POST['password'];

      if (!$username || !$password){
        exit;
      }

      $sql = "SELECT id, name FROM users WHERE (username = '$username'  OR email = '$username') AND password = '$password'";
      $result = $conn->query($sql);
      if (!$result || $result->num_rows == 0) {
        echo "<script type='text/javascript'>alert('המשתמש לא נמצא');</script>";
      } else {
        $row = $result->fetch_assoc();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $row["id"];
        $_SESSION["name"] = $row["name"];
        
        if(isset($_POST['remember'])){
          echo "<script type='text/javascript'>setCookie('user', '" .$row["id"]. ",". $row["name"]. "')</script>";
        }
        else {
          header("location: includes/home.php");
        }
      }
    // Close connection
    
    $conn->close();
  }
?>
<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="javascript/cookies.js"></script>
  <script src="javascript/tooltip.js"></script>
  <script src="javascript/loader.js"></script>
</head>
<body>

<div id="main" class="container"></div>

<div class="text-center">
  <h2 class="pt-4">כניסה למערכת</h2> 
</div>

<main id="main" class="container">
    <h2 class="pt-4">התחברות באמצעות משתמש קיים</h2>

    <a data-toggle="tooltip" title="בקרוב..." data-placement="top" href=""><img class="pt-4" src="media/googleLogin.png"></a>
   
    <a data-toggle="tooltip" title="בקרוב..." data-placement="top" href=""><img class="pt-4" src="media/facebookLogin.png"></a>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
      <div class="form-group">
        <label class="pt-4" for="username">שם משתמש</label>
        <input type="username" class="form-control" name="username" id="email" aria-describedby="emailHelp" placeholder="הכנס שם משתמש" required>
        <small id="emailHelp" class="form-text text-muted">ניתן להזין גם כתובת אימייל</small>
      </div>
      <div class="form-group">
        <label for="password">סיסמה</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="הכנס סיסמה" required>
      </div>
      <div class="form-check">
        <input name="remember" type="checkbox" class="form-check-input" id="check">
        <label class="form-check-label" for="check">זכור אותי</label>
      </div>
      <button type="submit" class="btn btn-primary">כניסה</button>
    </form>
</main>      

<div id="indexFooter">
  <h3 class="pt-4">אין לך עדיין משתמש?</h3> 
  <p><strong><a href="includes/signup.html" class="card-link">הירשם למערכת</a></strong></p> 
  <a class="title" href="includes/about.html">© Noodle</a>
</div>

</body>

</html>
