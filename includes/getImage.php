<?php
    include 'dbconn.php';
    session_start();
    $id = $_SESSION["id"];

    $sql = "SELECT profile_pic FROM users WHERE id = $id";
    $result = $conn->query($sql);
            
     if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();    
    }

    header("Content-type: image/jpeg");
    echo $row["profile_pic"];
?>