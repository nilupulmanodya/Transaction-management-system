<?php 
    //Start Session
    session_start();


    //Create Constants to Store Non Repeating Values
    define('SITEURL', 'http://localhost:8000/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'userthut');
    define('DB_PASSWORD', 'thut');
    define('DB_NAME', 'foodorder');
    
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database


?>
