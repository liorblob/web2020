<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/contentUpload.css">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  
  <?php
  include "session.php";
  ?>
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


  <script>
    $(document).ready(function() {
      $('#contentUploadForm').on('submit', function(e){
          $('#contentUpload').modal('show');
          //e.preventDefault();
      });
    });
    </script>
</head>
<body>
  <div class="modal fade" id="contentUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <h4 class="modal-title">אנו מודים לך על העלאת התוכן<br>בקשתך נקלטה ותועבר לאישור מנהל</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="window.location.href='home.php';">סגור</button>
      </div>
      </div>
    </div>
  </div>
  <div id="header"></div>
  <div class="text-center">
    <h2 class="pt-4">העלאת תוכן</h2> 
  </div>
  <div id="main" class="container">
    <div class="col-sm-6">
      <form id="contentUploadForm" method="POST" enctype="multipart/form-data" action="saveContent.php">
      <h4 class="pt-4">פרטי התוכן</h4>
      <div class="form-group">
        <label for="course">קורס</label>
        <select class="form-control" id="courseInput" name="courseInput" required>
          <option  value="" disabled selected>בחר/י קורס</option>
 
          <?php
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $sql = 'SELECT courses.name AS course_name, institutions.name AS inst_name 
            FROM courses, institutions 
            WHERE courses.inst_id = institutions.id
            ORDER BY courses.name ASC';
            $result = $conn->query($sql);
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo '<option>'.$row["course_name"]." (".$row["inst_name"].")".'</option>';
            }
          }
          ?>  


        </select>
      </div>
        <div class="form-group">
          <label for="dateInput">תאריך עדכניות</label>
          <input type="date" class="form-control" id="dateInput" name="dateInput" placeholder="" required>
        </div>
        <div class="form-group">
          <label for="titleInput">כותרת</label>
          <input type="text" class="form-control" id="titleInput" name="titleInput" placeholder="כותרת התוכן המועלה" required>
        </div>
          <div class="form-group">
            <label for="descriptionInput">תיאור התוכן</label>
            <textarea class="form-control" id="descriptionInput" name="descriptionInput" rows="3" placeholder="תיאור התוכן המועלה" required></textarea>
          </div>
        <h4 class="pt-4">בחירת קובץ</h4>
        <input type="file" class="form-control-file" id="contentInput" name="contentInput" required>
        <br>
        <script src="../javascript/ContentUploader.js"></script>
        <button type="submit" class="btn btn-primary">העלאה</button> 
        <br><br>

      </form>
    </div>
  </div>  
  <div id="footer"></div>       
</body>
</html>

