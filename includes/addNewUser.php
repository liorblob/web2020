<?php
    include 'dbconn.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
        header("location: ../index.php");
        exit;
    }

    $id = $_SESSION["id"];

    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $birthDate = $_POST["birthDate"];
    $contentRating = $_POST["contentRating"];

    $name = $firstname . ' ' . $lastname;

    $sql = "INSERT INTO users (id,username,password,name,email,is_admin)
    VALUES (7,'$username','$password','$name','$email',0)";
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
   window.location.href = "contentresults.php"
</script>

</body>
</html>
