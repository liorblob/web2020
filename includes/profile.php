<?php
  include 'dbconn.php';
  session_start();
  if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
    header("location: ../index.php");
    exit;
  }

  $id = $_SESSION["id"];
?>
<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/profile.css">
  <link rel="stylesheet" type="text/css" href="../css/feedback2.css">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../javascript/loader.js"></script>
  <script src="../javascript/validateProfile.js"></script>

  <script>
    $(document).ready(function() {
      $("#updateButton").click(function() {
        $(".backdrop").fadeTo(200, 1);
      });
      $("#exitButton").click(function() {
          $(".backdrop").fadeOut(200);
      });
      
    });
</script>
</head>
<body>
<div id="header"></div>
<div id="main" class="container">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="pt-4">הגדרות פרופיל</h2>
      <?php
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $id = $_SESSION["id"];

            $sql = "SELECT username, u.name as uname, email, i.name as iname FROM users AS u, institutions AS i WHERE u.id = $id AND i.id = u.inst_id";
            $result = $conn->query($sql);
            
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p><strong>שם משתמש: </strong>".$row["username"]."</p>";
                echo "<p><strong>כתובת אימייל: </strong>".$row["email"]."</p>";
                echo "<p><strong>שם: </strong>".$row["uname"]."</p>";
                echo "<p><strong>מוסד לימודים: </strong>".$row["iname"]."</p>";
            } 
          }
        ?>  
      <button id="updateButton" class="btn btn-primary">עדכן פרטי פרופיל</button>
      <div class="backdrop">
        <div id="popdiv" class="container-sm">
          <nav class="navbar navbar-dark bg-primary" id="fednav">
            <a class="navbar-brand" href="#">עדכון פרטי פרופיל</a>
          </nav>
          <form id="fedform" method="post" action="updateProfile.php" onsubmit="return validateForm()">
            <div class="form-group">
              <label for="EmailInput">כתובת אימייל</label>
              <input id="email" name="email" type="email" class="form-control" placeholder="כתובת אימייל" aria-describedby="sizing-addon1" required>
            </div>
            <div class="form-group">
              <label for="UsernameInput">שם משתמש</label>
              <input id="username" name="username" type="text" class="form-control" placeholder="שם משתמש" aria-describedby="sizing-addon1" required>
            </div>
            <div class="form-group">
              <label for="UsernameInput">סיסמה</label>
              <input id="password" name="password" type="password" class="form-control" placeholder="סיסמה" aria-describedby="sizing-addon1" required>
            </div>
            <div class="form-group">
              <label for="FirstNameInput">שם פרטי</label>
              <input id="firstname" name="firstname" type="text" class="form-control" placeholder="שם פרטי" aria-describedby="sizing-addon1" required>
            </div>
            <div class="form-group">
              <label for="LastNameInput">שם משפחה</label>
              <input id="lastname" name ="lastname" type="text" class="form-control" placeholder="שם משפחה" aria-describedby="sizing-addon1" required>
            </div>
            <div class="form-group">
              <label for="SchoolInput">מוסד לימודים</label>
              <select id="school" name="school" class="form-control" required>
                <option  value="" disabled selected>בחר/י מוסד לימוד</option>
                <option>המכללה האקדמית של תל אביב יפו</option>
                <option>אוניברסיטת תל אביב</option>
                <option>האוניברסיטה העברית</option>
                <option>הטכניון</option>
              </select>
            </div>
            <input class="btn btn-primary" type="submit" value="עדכן"/>
            <input type="reset" class="btn btn-primary" id="exitButton" value="ביטול"/>
          </form>      
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <div class="card">
          <div class="card-body text-center">
            <img src="getImage.php">
          </div>
        </div>
      </div>
      <form class="profileImage" name="formImage" enctype="multipart/form-data" action="updateImage.php" method="post">
        <div class="form-group">
          <label for="ProfilePictureInput">עדכון תמונת פרופיל</label>
          <div></div>
          <input name="image" id="imageUpload" type="file" required/>
          <div id="image-holder"></div>
          <script src="../javascript/imageUploader.js"></script>
        </div>
        <input class="btn btn-primary" type="submit" value="עדכן"/>
      </form>
    </div>
    <div class="col-sm-12">
      <h2 class="pt-4">ההעלאות שלי</h2>
      <div class="scroll">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>תאריך</th>
              <th>תחום</th>
              <th>קורס</th>
              <th>כותרת</th>
              <th>סוג</th>
              <th>סטטוס</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>04/03/2020</td>
              <td>מתמטיקה</td>
              <td>מתמטיקה ב'</td>
              <td>סיכום תרגולים 2020</td>
              <td>סיכום</td>
              <td class="bg-success">העלאה אושרה</td>
            </tr>
            <tr>
              <td>2</td>
              <td>01/04/2020</td>
              <td>מתמטיקה</td>
              <td>מתמטיקה ב'</td>
              <td>דף נוסחאות 2020</td>
              <td>סיכום</td>
              <td class="bg-info">ממתין לאישור</td>
            </tr>
            <tr>
              <td>3</td>
              <td>07/04/2020</td>
              <td>מתמטיקה</td>
              <td>מתמטיקה ב'</td>
              <td>מועד א' פתור 29.03.20 - ציון 96</td>
              <td>מבחן</td>
              <td class="bg-info">ממתין לאישור</td>
            </tr>
            <tr>
              <td><a href="contentUpload.html" class="card-link">העלה קובץ</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> 
  </div>
</div>
<div id="footer"></div>       
</body>
</html>
