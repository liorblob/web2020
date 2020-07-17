<?php
    include 'dbconn.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
        header("location: ../index.php");
        exit;
    }

    $id = $_SESSION["id"];

    $image = addslashes(file_get_contents($_FILES['image']['tmp_name'])); 
    $sql = "UPDATE users SET profile_pic = '{$image}' WHERE id = $id";
    
    if (!$conn->query($sql)) { 
        echo "<script type='text/javascript'>alert('אירעה שגיאה בעדכון התמונה');</script>";
    } else {
        echo "<script type='text/javascript'>alert('התמונה עודכנה בהצלחה');</script>";
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
   window.location.href = "profile.html"
</script>

</body>

</html>