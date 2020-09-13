<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/profile.css">
  <link rel="stylesheet" type="text/css" href="../css/feedback2.css">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">

  <?php
  include "session.php";
  ?>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../javascript/updateStatus.js"></script>

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
      <h2 class="pt-4">בקשות העלאת תכנים</h2>
      <div class="scroll">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>תאריך בקשה</th>
              <th>משתמש</th>
              <th>מוסד לימודים</th>
              <th>קורס</th>
              <th>כותרת</th>
              <th>תיאור</th>
              <th>סוג קובץ</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          <?php
          
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $id = $_SESSION["id"];

            $sql = 'SELECT m.date AS material_date, m.id AS material_id, m.name AS material_name, m.description AS material_desc, m.file_type AS material_type,  
            c.name AS course_name, 
            i.name AS inst_name,
            u.name AS user_name
            FROM `materials` AS m, `users` AS u, `courses` AS c, `institutions` AS i 
            WHERE m.status = "Pending Approval" AND m.course_id = c.id AND c.inst_id =i.id AND m.user_id = u.id';
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td>'.$row["material_date"].'</td>
                    <td>'.$row["user_name"].'</td>
                    <td>'.$row["inst_name"].'</td>
                    <td>'.$row["course_name"].'</td>
                    <td>'.$row["material_name"].'</td>
                    <td>'.$row["material_desc"].'</td>
                    <td>'.$row["material_type"].'</td>
                    <td><button value="'."Approved_".$row["material_id"].'" onclick=contentClick(this) class="btn btn-primary">אישור</button></td>
                    <td><button value="'."Declined_".$row["material_id"].'"  onclick=contentClick(this) class="btn btn-primary">דחיה</button></td>
                  </tr>';
                }
            } else {
                echo '<h4 class="card-title">לא נמצאו בקשות</h4>';
            }
          }
          ?>
          </tbody>
        </table>
      </div>
      <h2 class="pt-4">בקשות מורים פרטיים</h2>
        
      <div class="scroll">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>תאריך בקשה</th>
              <th>משתמש</th>
              <th>תחום לימוד</th>
              <th>משך שיעור</th>
              <th>מחיר</th>
              <th>רקע</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          <?php
          
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $id = $_SESSION["id"];


            $sql = 'SELECT u.name as name, t.teacher_id AS teacher_id, t.subject_main AS subject_main, t.lesson_time AS lesson_time,
            t.lesson_price AS lesson_price, t.background AS background, t.telephone AS telephone, t.reg_date AS reg_date
            FROM teachers AS t
            LEFT JOIN users AS u
            ON t.teacher_id = u.id
            WHERE t.status = "Pending Approval"';

            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td>'.$row["reg_date"].'</td>
                    <td>'.$row["name"].'</td>
                    <td>'.$row["subject_main"].'</td>
                    <td>'.$row["background"].'</td>
                    <td>'.$row["lesson_time"].'</td>
                    <td>'.$row["lesson_price"].'</td>
                    <td><button value="'."Approved_".$row["teacher_id"].'" onclick=teacherClick(this) class="btn btn-primary">אישור</button></td>
                    <td><button value="'."Declined_".$row["teacher_id"].'"  onclick=teacherClick(this) class="btn btn-primary">דחיה</button></td>
                  </tr>';
                }
            } else {
                echo '<h4 class="card-title">לא נמצאו בקשות</h4>';
            }
          }
          ?>



          </tbody>
        </table>
      </div>



      <h2 class="pt-4">בקשות משוב עבור תכנים</h2>
      <div class="scroll">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>תאריך בקשה</th>
              <th>משתמש</th>
              <th>שם זיהוי</th>
              <th>כותרת תוכן</th>
              <th>דירוג</th>
              <th>תגובה</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          <?php
          
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $id = $_SESSION["id"];


            $sql = 'SELECT mr.id AS rating_id, mr.material_id as material_id, mr.date AS material_date,mr.user_id AS user_id, mr.user_nickname AS nickname,
            mr.user_comment AS comment, mr.user_rating AS rating,
            m.name AS material_name,
            u.name AS user_name
            FROM materials_rating AS mr, materials AS m, users AS u
            WHERE mr.status = "Pending Approval" AND mr.user_id = u.id AND mr.material_id = m.id';

            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td>'.$row["material_date"].'</td>
                    <td>'.$row["user_name"].'</td>
                    <td>'.$row["nickname"].'</td>
                    <td>'.$row["material_name"].'</td>
                    <td>'.$row["rating"].'</td>
                    <td>'.$row["comment"].'</td>
                    <td><button value="'."Approved_".$row["rating_id"].'" onclick=ratingClick(this) class="btn btn-primary">אישור</button></td>
                    <td><button value="'."Declined_".$row["rating_id"].'"  onclick=ratingClick(this) class="btn btn-primary">דחיה</button></td>
                  </tr>';
                }
            } else {
                echo '<h4 class="card-title">לא נמצאו בקשות</h4>';
            }
          }
          ?>



          </tbody>
        </table>
      </div>


      <h2 class="pt-4">בקשות משוב עבור מורים</h2>
      <div class="scroll">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>תאריך בקשה</th>
              <th>משתמש</th>
              <th>שם זיהוי</th>
              <th>מורה מדורג</th>
              <th>דירוג</th>
              <th>תגובה</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          <?php
          
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $id = $_SESSION["id"];


            $sql = 'SELECT mr.id AS rating_id , mr.user_id AS rater_id, u.name AS rater_username,  mr.user_nickname AS rater_nickname,
            mr.teacher_id as teacher_id, teacher.name AS teacher_name ,mr.date AS rating_date, mr.user_comment AS comment, mr.user_rating AS rating
            FROM materials_rating AS mr,
            users AS u,
            (SELECT teacher_id, u.id, u.name
            FROM teachers AS t
            LEFT JOIN users AS u
            ON t.teacher_id = u.id) AS teacher
            WHERE mr.teacher_id = teacher.teacher_id
            AND rating_type = "teacher"
            AND mr.status = "Pending Approval"
            AND mr.user_id = u.id';

            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td>'.$row["rating_date"].'</td>
                    <td>'.$row["rater_username"].'</td>
                    <td>'.$row["rater_nickname"].'</td>
                    <td>'.$row["teacher_name"].'</td>
                    <td>'.$row["rating"].'</td>
                    <td>'.$row["comment"].'</td>
                    <td><button value="'."Approved_".$row["rating_id"].'" onclick=ratingClick(this) class="btn btn-primary">אישור</button></td>
                    <td><button value="'."Declined_".$row["rating_id"].'"  onclick=ratingClick(this) class="btn btn-primary">דחיה</button></td>
                  </tr>';
                }
            } else {
                echo '<h4 class="card-title">לא נמצאו בקשות</h4>';
            }
          }
          ?>
          </tbody>
        </table>
      </div>
    </div> 
  </div>
</div>
<div id="footer"></div>       
</body>
</html>
