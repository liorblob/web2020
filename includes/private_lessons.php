<!DOCTYPE html>
<html>
<head>
      <title>Add New Teacher</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../css/main.css">


  <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="../javascript/loader.js"></script>
  <script src="../javascript/validateProfile.js"></script>


       <style>
             table,th,td{
               border-style:solid;
               border-color:black;
               text-align:center;
               margin-left:auto; 
               margin-right:auto;
               font-size: 16px;
               padding: 3px;
              }

       </style>



</head>
<body>
    <div id="header"></div>
    <div id="main" class="container">
        
        <div class="row">
		<div class="col-md-9">
           <form action="teacher_search_php.php" method="post">
               חיפוש מורה לפי תחום לימוד
               <input type="text" name="subject_main"> 
               <input type="Submit" value="חפש">
            </form>
        </div>
		<div class="col-md-3">
             <button onclick="window.location.href='add_teacher.html'">הירשם למאגר מורים פרטיים</button>
        </div>
        </div>



<?php
  include 'dbconn.php';
 /* session_start();
  if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
    header("location: ../index.php");
    exit;
  }

   $id = $_SESSION["id"];
*/
        // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
		  
          //  $id = $_SESSION["id"];




$sql = "SELECT * FROM teachers INNER JOIN users ON teachers.teacher_id=users.id";  
$result = $conn->query($sql);


echo "<br>";
if ($result->num_rows > 0) {
    echo "
    <table><tr>
      <th style='background-color:#33FF90'>שם מורה</th>
      <th style='background-color:#33FF90'>תחום לימוד</th>
      <th style='background-color:#33FF90'>רקע</th>
      <th style='background-color:#33FF90'>משך שיעור</th>
      <th style='background-color:#33FF90'>מחיר שיעור</th>
    </tr>";
    // output data of each row
 
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["name"]."</td>
        <td>".$row["subject_main"]."</td>
        <td>".$row["background"]."</td>
        <td>".$row["lesson_time"]."</td>
        <td>".$row["lesson_price"]."</td>
        </tr>";


      echo "<td>"; 
      echo '<img src="data:image/jpeg;base64,'.base64_encode($row['profile_pic'] ).'" height="200" width="200" />';
      echo "<br>";
      echo "</td>";

      echo "<td>"; 
      $sql2 ="SELECT * FROM teachers_reputation WHERE teacher_id = '$row[teacher_id]'";
      $result2 = $conn->query($sql2);
      if ($result2->num_rows > 0){
                $sum=0;
                $length=0;
      while($row2 = $result2->fetch_assoc()){
                $sum = $sum + $row2['grade'];
                $length++;
           }
      		  echo "דירוג ממוצע הינו";
			  echo "<br>";
			  echo ($sum/$length);
			  echo "<br>";
         }

      echo "</td>"; 


    }
    echo "</table>";
  
} else {
    echo "0 results";
}


$conn->close();
}
?>
   </div>
<div id="footer"></div>       

</body>
</html>