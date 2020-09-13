<?php
    include 'dbconn.php';
    session_start();
   /* if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
        header("location: ../index.php");
        exit;
    } 

    $id = $_SESSION["id"];
    */

    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $inst_name = $_POST["school"];
    $name = $_POST["firstName"]." ".$_POST["lastName"];


    $data=addslashes(file_get_contents($_FILES["imageUpload"]['tmp_name'])); 
    /*
    $file_size=$_FILES["imageUpload"]['size'];
    $temp_file_type = $_FILES["imageUpload"]["name"];
    $file_type = end((explode(".", $temp_file_type))); # extra () to prevent notice
    */


    $user_query = "SELECT username, email FROM users WHERE username = '$username' OR email = '$email'";
    $user_result = $conn->query($user_query);
    if($user_result && $user_result->num_rows > 0){
        echo "<script type='text/javascript'>alert('שם המשתמש או כתובת האימייל כבר קיימים במערכת');</script>";
    }
    else{

      $inst_sql = "SELECT id FROM institutions
      WHERE name = '$inst_name'";
      $result = $conn->query($inst_sql);
      $inst= $result->fetch_assoc();
      $inst_id = $inst["id"];

      $sql = "INSERT INTO users (username,password,name,email,profile_pic,inst_id,is_admin)
      VALUES ('$username','$password','$name','$email','$data',$inst_id,0)";

      $result = $conn->query($sql);
    }

   $conn->close();
?>


<!DOCTYPE html>
<head>
  <title>Noodle</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<script type='text/javascript'>
   window.location.href = "../index.php"
</script>

</body>
</html>
