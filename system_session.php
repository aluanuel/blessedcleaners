<?php
session_start();// Starting Session
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include 'connection.php';
include 'functions.php';
// Storing Session
$user_check=$_SESSION['system_admin'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($conn,"SELECT c.username,c.idusers FROM users c, settings s WHERE username='$user_check' AND c.idsettings=s.idsettings");
$row = mysqli_fetch_assoc($ses_sql);
$admin_session =$row['username'];
$company_name = getCompanyName($row['idusers']);
if(!isset($admin_session)){
mysqli_close($conn); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>