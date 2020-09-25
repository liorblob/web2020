<?php
 if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {     
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        
    die();
  }

  include '../includes/dbconn.php';

  $id = 1;

  // Check connection
  if ($conn->connect_error) {
      echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
  }
  else {
    $courseName = $_POST["course"];
    
    
    $sql = 'SELECT id FROM courses WHERE name = "'.$courseName.'"';
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $course_id = $row["id"];     


    $name=$_POST["titleInput"];
    $description=$_POST["descriptionInput"];
    $date=$_POST["dateInput"];
    $data=addslashes(file_get_contents($_FILES["contentInput"]['tmp_name'])); 
    $file_size=$_FILES["contentInput"]['size'];
    $temp_file_type = $_FILES["contentInput"]["name"];
    $temp_file_type2 = explode(".", $temp_file_type);
    $file_type = end($temp_file_type2);


    $status = "Pending Approval";

    $sql = "INSERT into materials(name,description,date,course_id,data,user_id,status,file_type,file_size)
      values
      ('".$name."','".$description."','".$date."','".$course_id."','".$data."','".$id."','".$status."','".$file_type."','".$file_size."')";

    if ($conn->query($sql)==FALSE){
      echo $sql;
      $conn->error;
      exit();
    }
    echo '<h4 style="text-align:center">התוכן נשמר בהצלחה. אנא רענן את העמוד</h4>';
    $conn->close();
  }
?>