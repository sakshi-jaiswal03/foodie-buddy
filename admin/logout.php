<?php 
//include SITEURL from constants
include('config/constants.php');

//destrroy session
session_destroy();//unsets $_SESSION['user']
//redirect to login page
header('location:'.SITEURL.'admin/login.php');
?>