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
                      <img src='data:image/jpeg;base64,".base64_encode($row['profile_pic'])."' />
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

            $sql = "SELECT * FROM materials_rating WHERE teacher_id = ".$teacher_id."";

            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo '<tr>
                    <td>'.$row["user_rating"].'</td>
                    <td>'.$row["user_comment"].'</td>

                  </tr>';
                }
            } else {
                echo '<h4 class="card-title">לא נמצאו דירוגים</h4>';
            }
          }
          ?>
          </tbody>
        </table>
      </div>
    </div> 
    
   <div class="col-sm-12">
    <br>
    <h2 class="pt-4">הזנת משוב חדש למורה</h2
    <br>
      <div class="scroll">
      <form id="fedform" method="post" action="add_teacher_rating.php" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="formGroupExampleInput">שם משתמש</label>
                    <input id="nickname" name="nickname" type="text" class="form-control" placeholder="הזן שם להזדהות" aria-describedby="sizing-addon1" required>
                    <small id="UsernameHelpBlock" class="form-text text-muted">
                    הינך יכול להזדהות בשמך או לבחור שם אנונימי לבחירתך
                </small>
                </div>

                <div class="form-group">
                    <label for="formGroupExampleInput2">דירוג</label>
                    <select class="custom-select custom-select-lg mb-3" id="teacherRating" name="teacherRating" autocomplete="off" value="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>

                </div>

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

                 <div class="form-group">
                    <label for="exampleFormControlTextarea1">תגובה</label>
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
