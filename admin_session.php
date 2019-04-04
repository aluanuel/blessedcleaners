<?php
session_start();// Starting Session
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
require_once 'connection.php';
require_once 'functions.php';
// Storing Session
$user_check=$_SESSION['admin'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($conn,"SELECT * FROM users c, settings s WHERE username='$user_check' AND c.idsettings=s.idsettings");
$row = mysqli_fetch_assoc($ses_sql);
$admin_session =$row['username'];
// $id_company = $row['idsettings'];
$company_name = getCompanyName($row['idusers']);
$company_id = getCompanyId($row['idusers']);
if(!isset($admin_session)){
mysqli_close($conn); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>