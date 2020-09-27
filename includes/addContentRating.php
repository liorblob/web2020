<?php
    include 'dbconn.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
        header("location: ../index.php");
        exit;
    }

    $id = $_SESSION["id"];

    $rating_type = "material";
    $material_id = $_POST["ratingValue"];
    $nickname = $_POST["nickname"];
    $contentRating = $_POST["rate"];
    $comment = $_POST["comment"];
    $status = "Pending Approval";


    $sql = "INSERT INTO materials_rating (rating_type,material_id,date,user_id,user_nickname,user_comment,user_rating,status)
    VALUES ('$rating_type','$material_id',now(),'$id','$nickname','$comment','$contentRating','$status')";
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
   window.location.href = "uploadRatingMessage.html"
</script>

</body>
</html>
