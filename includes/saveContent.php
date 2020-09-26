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
      echo "error";
      echo $sql;
      $conn->error;
      exit();
    }
    $conn->close();
  }
?>


<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<script type='text/javascript'>
   window.location.href = "contentUpload.php"
</script>

</body>

</html>