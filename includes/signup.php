<!DOCTYPE html>
  <head>
    <title>Noodle</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/signup.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    
    <?php
    include 'dbconn.php';
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="../javascript/tooltip.js"></script>
    
<script>
$(document).ready(function() {
  $('#signUpForm').on('submit', function(e){
      $('#registration').modal('show');
      e.preventDefault();
  });
});
</script>
  </head>
  <body>
    <div class="modal fade" id="registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <h4 class="modal-title">הרשמתך נקלטה בהצלחה והועברה לאישור מנהל</h4>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="window.location.href='../index.php';">סגור</button>
        </div>
        </div>
      </div>
    </div>
    <div id="header"></div>
    <main id="main" class="container">
      <div>
        <form id="fedform" method="post" enctype="multipart/form-data" action="addNewUser.php" onsubmit="return validateForm()">
        <h2 class="pt-4">הרשמת משתמש חדש</h2>
          <div class="form-group">
            <label class="pt-4" for="email">כתובת אימייל</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="הכנס כתובת אימייל" required>
          </div>
          <div class="form-group">
            <label for="username">שם משתמש</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="הכנס שם משתמש" required>
          </div>
          <div class="form-group">
            <label for="password">הקלד/ת סיסמה</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="הכנס סיסמה" required>
          </div>
          <h4 class="pt-4">פרטים אישיים</h4>
          <div class="form-group">
            <label for="firstName">שם פרטי</label>
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" required>
          </div>
          <div class="form-group">
            <label for="lastName">שם משפחה</label>
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" required>
          </div>
          <div class="form-group">
          <label for="profilePic">בחר תמונת פרופיל</label>
            <div class="profileImage">
              <input type="file" class="form-control-file" id="imageUpload" name="imageUpload">
              <div id="image-holder"></div>
              <script src="../javascript/imageUploader.js"></script>
            </div>
          </div>
            <h4 class="pt-4">פרטי לימוד</h4>
            <div class="form-group">
              <label for="schoolSelect">בחר/י מוסד לימוד</label>
              <select class="form-control" id="school" name="school" required>
                <option  value="" disabled selected>בחר/י מוסד לימוד</option>
                <?php
                // Check connection
                if ($conn->connect_error) {
                    echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
                }
                else { 
                    $sql = 'SELECT institutions.name AS inst_name FROM institutions';
                    $result = $conn->query($sql);
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                    echo '<option>'.$row["inst_name"].'</option>';
                    }
                }
                ?>  
              </select>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary">הרשמה</button> 
          </form>
          <br><br>
          <button class="btn btn-primary" onclick="window.location.href = '../index.php'">חזרה לדף כניסה</button>
         <br><br>
      </div>
    </main>    
    <div id="footer"></div>       
</body>
  </body>
</html>
