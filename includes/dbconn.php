<?php
 $servername = "localhost";
 $username = "isliorbo";
 $password = "ThuTi?O$e4E";
 $dbname="isliorbo_noodle";

 error_reporting(E_ALL ^ E_WARNING);

 // Create connection
 $conn = new mysqli($servername, $username, $password,$dbname);
 // Check connection
 if ($conn->connect_error) {
    echo "<script type='text/javascript'>alert('תקלה בהתחברות למסד הנתונים');</script>";
    die();
 }
 else {
    $conn->query("SET NAMES 'utf8'");
 }
?>