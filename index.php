<?php
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

      $sql = "SELECT id, name, is_admin FROM users WHERE (username = '$username'  OR email = '$username') AND password = '$password'";
      $result = $conn->query($sql);
      if (!$result || $result->num_rows == 0) {
        echo "<script type='text/javascript'>alert('המשתמש לא נמצא');</script>";
      } else {
        $row = $result->fetch_assoc();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $row["id"];
        $_SESSION["name"] = $row["name"];
        $_SESSION["is_admin"] = $row["is_admin"];

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
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="css/about.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="javascript/cookies.js"></script>
  <script src="javascript/tooltip.js"></script>
  <script src="javascript/loader.js"></script>
</head>
<body>
    <div id="wrapper" class="container">
		<div id="internalWrapper" class="container">
			<header>
        <div id="logoAndHead">
				<img src= "../Noodle/media/noodles.png" class="img-fluid">
        <h1>Noodle</h1>
        <br>
        <h2>מערכת לשיתוף חומרי לימוד בין סטודנטים</h2>
				</div>
			</header>
			

    <main>

       <section class="text-center mt-4">
					<p>
            האתר הוקם על ידי סטודנטים למען סטודנטים.<br>
            כסטודנטים אנו מכירים היטב את המצוקה במציאת חומרי לימוד במהלך הלימודים באקדמיה.
            מטרתנו היא הקמת אתר אחוד שיהווה מרכז אחד לשיתוף וחיפוש חומרי לימוד מכל מוסד לימודים ובכל קורס.<br>
            אנו מזמינים אתכם לשתף, לחפש ולהשאיר חוות דעת על חומרי הלימוד באתר.
					</p>

           <video controls>
               <source src="media/noodle.mp4" type="video/mp4">
               דפדפן זה לא תומך בוידאו.
           </video>

           <h2 class="pt-4">כניסה למערכת</h2> 


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
              <h3 class="pt-4">אין לך עדיין משתמש?</h3> 
              <p><strong><a href="includes/signup.php" class="card-link">הירשם למערכת</a></strong></p> 

     </section>

    </main>      


     <div id="indexFooter">
        <footer class="mt-3 p-1" id="footer">  
            <div class="row">
		        <div class="col-md-4">
                </div>
                
                  <div class="col-md-4">
                      <a class="title">© Noodle</a>
			      </div>
			    
			    <div class="col-md-4">	
			    </div>
	       	</div>
        </footer>
    </div>
 
 
 
	</div>	
  </div>
</body>

</html>
