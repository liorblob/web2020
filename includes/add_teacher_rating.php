<?php

    include 'session.php';
 
    $id = $_SESSION["id"];

    $rating_type = "teacher";
    $teacher_id = $_POST["teacher_id"];
    $nickname = $_POST["nickname"];
    $teacherRating = $_POST["rate"];
    $comment = $_POST["comment"];
    $status = "Pending Approval";


    $sql3 = "INSERT INTO materials_rating (rating_type, teacher_id, user_nickname, user_rating, user_comment, status, date, user_id) VALUES ('".$rating_type."','".$teacher_id."','".$nickname."',".$teacherRating.",'".$comment."','".$status."',now(),".$id.");";
    $conn->query($sql3);
    echo $sql3;

//   header( 'Location: private_lessons.php' ) ;

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
window.location.href = "uploadRatingMessage.html"
</script>

</body>
</html>