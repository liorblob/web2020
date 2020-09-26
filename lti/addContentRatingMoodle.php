<?php
   if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {     
    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
        
    die();
  }

  include '../includes/dbconn.php';

  $id = 1;

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

  echo '<h4 style="text-align:center">הדירוג נשמר בהצלחה. אנא רענן את העמוד</h4>';
?>


