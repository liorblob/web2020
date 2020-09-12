<?php
  include 'dbconn.php';
  session_start();

  if(isset($_SESSION["moodle"]) && $_SESSION["moodle"] == true){
    $_SESSION["id"] = 1;
    exit;
  }

  if(!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"] == true){
    header("location: ../index.php");
    exit;
  }

  $id = $_SESSION["id"];

  echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';

  if($_SESSION["is_admin"] == 1){
  echo '<script src="../javascript/adminLoader.js"></script>';
  }
  else{
    echo '<script src="../javascript/loader.js"></script>';
  }

?>