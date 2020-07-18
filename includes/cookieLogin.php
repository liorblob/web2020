<?php
    if($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'])) {     
        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
             
        die();
    }

    session_start();

    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $_POST["id"];
    $_SESSION["name"] = $_POST["name"];
?>