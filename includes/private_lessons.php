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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../javascript/validateProfile.js"></script>

</head>
<body>
    <div id="header"></div>
      <div id="main" class="container">
        
       <div class="row">
	    	<div class="col-md-9">
           <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
               חיפוש מורה לפי תחום לימוד
               <input type="text" name="subject_main" > 
               <input type="Submit" value="חפש" class="btn btn-primary">
            </form>
        </div>
	    	<div class="col-md-3">
             <button class="btn btn-primary" onclick="window.location.href='add_teacher.html'">הירשם למאגר מורים פרטיים</button>
        </div>
        </div>


          <?php

          if($_SERVER["REQUEST_METHOD"] == "POST"){
            $subject_main = $_POST["subject_main"];
            $sql = "SELECT t.teacher_id, u.name, u.profile_pic ,t.subject_main, t.lesson_time, t.lesson_price, t.background, t.telephone, ROUND(SUM(r.grade)/COUNT(r.grade),1) as avg_grade
            FROM teachers as t
            LEFT JOIN users as u ON t.teacher_id=u.id
            LEFT JOIN teachers_reputation as r ON r.teacher_id = t.teacher_id
            WHERE t.subject_main LIKE '%".$subject_main."%'
            GROUP BY t.teacher_id;"; 

          }
          else{
            $sql = "SELECT t.teacher_id, u.name, u.profile_pic ,t.subject_main, t.lesson_time, t.lesson_price, t.background, t.telephone, ROUND(SUM(r.grade)/COUNT(r.grade),1) as avg_grade
            FROM teachers as t
            LEFT JOIN users as u ON t.teacher_id=u.id
            LEFT JOIN teachers_reputation as r ON r.teacher_id = t.teacher_id
            GROUP BY t.teacher_id;";  
          }


          $result = $conn->query($sql);

          echo "<br>";
          if ($result->num_rows > 0) {
              echo "
              <table class='table table-striped'><tr>
                <th>תמונה</th>
                <th>שם מורה</th>
                <th>תחום לימוד</th>
                <th>רקע</th>
                <th>משך שיעור</th>
                <th>מחיר שיעור</th>
                <th>דירוג ממוצע</th>
              </tr>";
              // output data of each row
          
              while($row = $result->fetch_assoc()) {
                  echo "<tr>
                  <td>
                    <div class='teacherImage'>
                      <img src='data:image/jpeg;base64,".base64_encode($row['profile_pic'])."'/>
                    </div>
                  </td>
                  <td>".$row["name"]."</td>
                  <td>".$row["subject_main"]."</td>
                  <td>".$row["background"]."</td>
                  <td>".$row["lesson_time"]."</td>
                  <td>".$row["lesson_price"]."</td>
                  <td>".$row["avg_grade"]."</td>
                  </tr>";

              }
              echo "</table>";
            
          } else {
              echo "0 results";
          }


          $conn->close();

          ?>

</div>
</div>



<div id="footer"></div>       

</body>
</html>