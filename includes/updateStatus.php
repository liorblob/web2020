<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {     
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
            
        die();
    }

    $status = $_POST["status"];
    $material_id = $_POST["material_id"];
    
    include 'dbconn.php';
    $sql = "UPDATE materials SET status = '$status' WHERE id = $material_id";
    
   
    if (!$conn->query($sql)) { 
        echo "<script type='text/javascript'>alert('אירעה שגיאה בעדכון הקובץ');</script>";
    }

    $conn->close();
?>