<?php
   $servername = "localhost:3306";
   $username = "dbuser";
   $password = "123456";
   $dbname="noodle";

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