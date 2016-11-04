<?php
session_start(); // Starting Session
require("../../config.php");
// Storing Session
$user_check  = $_SESSION['login_user'];
$id = $_SESSION['login_id'];
// SQL Query To Fetch Complete Information Of User
$ses_sql = mysql_query("select * from nguoidung where nguoidung.nguoidung_taikhoan ='$user_check'");
$row = mysql_fetch_array($ses_sql);
$login_session =$row['nguoidung_taikhoan'];
if(!isset($login_session)){
    // header('Location: ../views/login.php'); // Redirecting To Home Page
    echo "<script>window.location.replace('../views/login.php')</script>";
}
?>