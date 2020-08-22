<?php
  include 'dbconn.php';
  session_start();
  if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
    header("location: ../index.php");
    exit;
  }

//$id = $_SESSION["id"];

        // Check connection
          if ($conn->connect_error) {
              echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
          }
          else { 
		  
       //     $id = $_SESSION["id"];

$teacher_id = $_POST["2"];
$subject_main=$_POST["subject_main"];
$subject_2=$_POST["subject_2"];
$subject_3=$_POST["subject_3"];
$background=$_POST["background"];
$contact=$_POST["contact"];

$sql2="INSERT INTO teachers ("2",subject_main,subject_2,subject_3,background,contact) VALUES (".$teacher_id.",'".$subject_main."','".$subject_2."','".$subject_3."','".$background."','".$contact."');";
$conn->query($sql2);


$conn->close();

		  }
?>