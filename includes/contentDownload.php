<?php
  include 'dbconn.php';
  session_start();
  if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
    header("location: ../index.php");
    exit;
  }

  $material_id = $_GET["id"];

  // Check connection
  if ($conn->connect_error) {
      echo '<h4 class="alert-danger">תקלה בהתחברות למסד הנתונים: '. $conn->connect_error .'</h4>';
  }
  else {
    $sql = "SELECT name,data,file_size,file_type FROM materials WHERE id = $material_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $size = $row["file_size"];
    $type = strtolower($row["file_type"]);
    $data = $row["data"];
    $name = $row["name"].".".$type;
    header("Content-length: $size");
    header("Content-type: $type");
    header("Content-Disposition: attachment; filename=$name");
    if(ob_get_length() > 0) {
      ob_clean();
    }
    flush();
    echo $data;
    $conn->close();
    exit;
  }
?>