<?php
session_start(); // Starting Session
require("../../config.php");
$error=0;
if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = 1;
    }
    else
    {
        // Define $username and $password
        $username=$_POST['username'];
        $password=$_POST['password'];
        // To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
        $password = md5($password);
        $sql_user = "select * from nguoidung where nguoidung.nguoidung_taikhoan = '$username' and nguoidung.nguoidung_matkhaudn= '$password'";
        $query = mysql_query($sql_user);
        $listuser = mysql_fetch_array($query);
        $rows = mysql_num_rows($query);
        if ($rows == 1) {
            $_SESSION['login_user']=$username; // Initializing Session
            $_SESSION['login_id']=$listuser['nguoidung_id']; // Initializing Session
            $_SESSION['user_role']=$listuser['nguoidung_quyen'];
            // header("location: index.php"); // Redirecting To Other Page
            echo "<script>window.location.replace('index.php')</script>";
        } else {
            $error = 1;
        }
    }
}
?>