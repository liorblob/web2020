<?php

    include 'session.php';
 
    $id = $_SESSION["id"];

    $rating_type = "teacher";
    $teacher_id = $_POST["teacher_id"];
    $nickname = $_POST["nickname"];
    $teacherRating = $_POST["teacherRating"];
    $comment = $_POST["comment"];
    $status = "Pending Approval";


    $sql3 = "INSERT INTO materials_rating (rating_type, teacher_id, user_nickname, user_rating, user_comment, status, date, user_id) VALUES ('".$rating_type."','".$teacher_id."','".$nickname."',".$teacherRating.",'".$comment."','".$status."',now(),".$id.");";
    $conn->query($sql3);

   header( 'Location: private_lessons.php' ) ;

   $conn->close(); 
?>

