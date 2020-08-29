<?php

  include 'session.php';

  $teacher_id=$_SESSION["id"];
  $subject_main=$_POST["subject_main"];
  $lesson_time=$_POST["lesson_time"];
  $lesson_price=$_POST["lesson_price"];
  $background=$_POST["background"];
  $telephone=$_POST["telephone"];

$sql2="INSERT INTO teachers (teacher_id,subject_main,lesson_time,lesson_price,background,telephone) VALUES (".$teacher_id.",'".$subject_main."',".$lesson_time.",".$lesson_price.",'".$background."','".$telephone."');";
$conn->query($sql2);

header( 'Location: profile.php' ) ;


$conn->close();

		
?>