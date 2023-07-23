<?php

//start session 
 session_start();
 //create constants for storing non repeating values
   define('SITEURL', 'http://127.0.0.1/foodie-buddy/');
   define('LOCALHOST', 'root');
   define('DB_USERNAME', 'localhost');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'foodie-buddy');
   // define( '$id', 'id');
   $conn= mysqli_connect(DB_USERNAME, LOCALHOST, DB_PASSWORD) or die(mysqli_error($conn)); //database connection
   $db_select = mysqli_select_db($conn, DB_NAME ) or die(mysqli_error($conn));  //selectng database

?>