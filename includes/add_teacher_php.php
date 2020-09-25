<?php
  include 'dbconn.php';
  session_start();
  if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
      header("location: ../index.php");
      exit;
  }

  $id=$_SESSION["id"];

  $subject_main=$_POST["subject_main"];
  $lesson_time=$_POST["lesson_time"];
  $lesson_price=$_POST["lesson_price"];
  $background=$_POST["background"];
  $telephone=$_POST["telephone"];
  $status = "Pending Approval";

  
  $sql = "INSERT INTO teachers (teacher_id, subject_main, lesson_time, lesson_price, background, telephone, reg_date, status)
    VALUES ('$id','$subject_main','$lesson_time','$lesson_price','$background','$telephone',now(),'$status')";
  $result = $conn->query($sql);
  
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
window.location.href = "private_lessons.php"
</script>

</body>
</html>