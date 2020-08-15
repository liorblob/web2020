<?php
  include 'dbconn.php';
  session_start();
  if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
    header("location: ../index.php");
    exit;
  }

  $id = $_SESSION["id"];

  // Check connection
  if ($conn->connect_error) {
      echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
  }
  else {
    $courseName = explode(" (",$_POST["courseInput"])[0];
    
    $sql = 'SELECT id FROM courses WHERE name = "'.$courseName.'"';
    echo $sql;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $course_id = $row["id"];     


    $name=$_POST["titleInput"];
    $description=$_POST["descriptionInput"];
    $date=$_POST["dateInput"];
    $data=addslashes(file_get_contents($_FILES["contentInput"]['tmp_name'])); 
  

    $sql = "INSERT into materials(name,description,date,course_id,data) values ('".$name."','".$description."','".$date."','".$course_id."','".$data."')";

    if ($conn->query($sql)==FALSE){
      echo $sql;
      $conn->error;
      exit();
    }
    echo "החומר הועלה בהצלחה";
    $conn->close();
  }
?>