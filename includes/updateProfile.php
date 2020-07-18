<?php
    include 'dbconn.php';
    session_start();
    if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
        header("location: ../index.php");
        exit;
    }

    $id = $_SESSION["id"];

    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email=$_POST['email'];
    $school=$_POST['school'];

    $schoolQuery = "SELECT id FROM institutions WHERE name = '$school';";
    $result = $conn->query($schoolQuery);
    if (!$result || $result->num_rows == 0) {
        echo "<script type='text/javascript'>alert('מוסד הלימודים לא נמצא');</script>";
    } else {
        $row = $result->fetch_assoc();
        $schoolID = $row["id"];
        $name = $firstname . ' ' . $lastname;
        $updateQuery = "UPDATE users SET name = '$name', email = '$email', inst_id = $schoolID WHERE id = $id;";
        $result = $conn->query($updateQuery);
        if(!$result){
            echo "<script type='text/javascript'>alert('אירעה שגיאה בעדכון הפרטים');</script>";
        } else{
            echo "<script type='text/javascript'>alert('הפרטים עודכנו בהצלחה');</script>";
        }
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