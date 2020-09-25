<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {     
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
            
        die();
    }

    $status = $_POST["status"];
    $teacher_id = $_POST["teacher_id"];

    include 'dbconn.php';
    $sql = "UPDATE teachers SET status = '$status' WHERE teacher_id = '$teacher_id'";

    
    if (!$conn->query($sql)) { 
        echo "<script type='text/javascript'>alert('אירעה שגיאה בעדכון הקובץ');</script>";
    }

    $conn->close();
?>