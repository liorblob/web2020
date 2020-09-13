<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" type="text/css" href="../css/profile.css">
  <link rel="stylesheet" type="text/css" href="../css/rating.css">
  <link rel="stylesheet" type="text/css" href="../css/feedback2.css">
  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">

  <?php
  include "session.php";
  ?>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
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
      <h2 class="pt-4">פרופיל המורה</h2>
      <?php
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $id = $_GET["id"];

            $sql = "SELECT * FROM teachers INNER JOIN users ON teachers.teacher_id=users.id WHERE teacher_id = ".$id.""; 
            $result = $conn->query($sql);
            
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='teacherImage'>
                      <img src='data:image/jpeg;base64,".base64_encode($row['profile_pic'])."' style='width:20%;height:20%;' />
                      </div>";
                echo "<br>";
                echo "<p><strong>שם: </strong>".$row["name"]."</p>";
                echo "<p><strong>אימייל: </strong>".$row["email"]."</p>";
                echo "<p><strong>טלפון: </strong>".$row["telephone"]."</p>";
            } 
          }
        ?>  

    </div>

    <div class="col-sm-12">
      <h2 class="pt-4">רשימת הדירוגים עבור המורה</h2>
      <div class="scroll">


      <table class="table table-striped">
          <thead>
            <tr>
              <th>תאריך דירוג</th>
              <th>שם המדרג</th>
              <th>דירוג</th>
              <th>משוב</th>
            </tr>
          </thead>
          <tbody>

          <?php
          
          // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
            $teacher_id = $_GET["id"];

            $sql = 'SELECT mr.id AS rating_id , mr.user_id AS rater_id, u.name AS rater_username,  mr.user_nickname AS rater_nickname,
            mr.teacher_id as teacher_id, teacher.name AS teacher_name ,mr.date AS rating_date, mr.user_comment AS comment, mr.user_rating AS rating
            FROM materials_rating AS mr,
            users AS u,
            (SELECT teacher_id, u.id, u.name
            FROM teachers AS t
            LEFT JOIN users AS u
            ON t.teacher_id = u.id) AS teacher
            WHERE mr.teacher_id = '.$teacher_id.'
            AND mr.teacher_id = teacher.teacher_id
            AND rating_type = "teacher"
            AND mr.status = "Approved"
            AND mr.user_id = u.id';

            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td>'.$row["rating_date"].'</td>
                    <td>'.$row["rater_nickname"].'</td>
                    <td>'.$row["rating"].'</td>
                    <td>'.$row["comment"].'</td>
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
    
   <div class="col-sm-12">
    <br>
    <br>
      <div class="scroll">
      <form id="fedform" method="post" action="add_teacher_rating.php" onsubmit="return validateForm()">
      <h2 class="pt-4">הזנת משוב חדש למורה</h2>

                <div class="form-group">
                    <label for="formGroupExampleInput">שם משתמש</label>
                    <input id="nickname" name="nickname" type="text" class="form-control" placeholder="הזן שם להזדהות" aria-describedby="sizing-addon1" required>
                    <small id="UsernameHelpBlock" class="form-text text-muted">
                    הינך יכול להזדהות בשמך או לבחור שם אנונימי לבחירתך
                    </small>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2">דירוג</label>
                    <br>
                    <div class="rate">
                           <input type="radio" id="star5" name="rate" value="5" />
                           <label for="star5" title="מצויין">5 stars</label>
                           <input type="radio" id="star4" name="rate" value="4" />
                           <label for="star4" title="טוב">4 stars</label>
                           <input type="radio" id="star3" name="rate" value="3" />
                           <label for="star3" title="בסדר">3 stars</label>
                           <input type="radio" id="star2" name="rate" value="2" />
                           <label for="star2" title="לא טוב">2 stars</label>
                           <input type="radio" id="star1" name="rate" value="1" />
                           <label for="star1" title="גרוע">1 star</label>
                    </div>
                </div>
                <br><br><br>
                <small id="UsernameHelpBlock" class="form-text text-muted">
                אנא דרג את המורה הפרטי בהתאם לחוויתך
                </small>
                <?php
                
                  // Check connection
                  if ($conn->connect_error) {
                      echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
                        }
                  else { 
                    $teacher_id = $_GET["id"];
                  
                    echo '<input name="teacher_id" value="'.$teacher_id.'" type="hidden" />';
                      }
                ?>
                <br>
                <div class="form-group">
                    <label for="comment">תגובה</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3" form="fedform"></textarea>
                    <small id="commentHelpBlock" class="form-text text-muted">התגובה תתפרסם לכל המשתמשים במערכת. אנא מכם, שמרו על שפה נאותה</small>
                </div>
                <input id="sumbit_btn" class="btn btn-primary" type="submit" value="שלח"/>
      </form>
    
    </div>
  </div>

  </div>
</div>
<div id="footer"></div>       
</body>
</html>
