<?php 
    require("../config.php");
    include("class.smtp.php");
    include("class.phpmailer.php"); 
    include("functions.php"); 
    function getIDByUserName($userName){
        $query = "select * from nguoidung where nguoidung_taikhoan = '$userName'";
        return mysql_query($query);
    }
    
    if(isset($_POST['action'])){
        $account = $_POST['account'];
        $getUser = getIDByUserName($account);
        if(mysql_num_rows($getUser) > 0){
            $user = mysql_fetch_array($getUser);
            $matkhau = $user['nguoidung_magioithieu'];
            $email = $user['nguoidung_mail'];
        }
        else {
            $matkhau = "";
        }
        
        if($matkhau != ""){
            // sent mail
            $verificationCode = base64_encode($matkhau);
 
            // send the email verification
            $verificationLink = "https://btcclub-thangtgm.c9users.io/models/activate.php?code=" . $verificationCode;

            $htmlStr = "";
            $htmlStr .= "Hi " . $email . ",<br /><br />";

            $htmlStr .= "Vui lòng click vào link dưới để cập nhật mật khẩu tài khoản của bản trên BTCCLUB.INFO.<br /><br /><br />";
            $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";

            $htmlStr .= "Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br />";
            $htmlStr .= "<a href='https://btcclub.info/' target='_blank'>BTCCLUB.INFO Cho đi, nhận lại - Hệ thống luân chuyển sự giàu có.</a><br />";


            $name = "Admin BTCCLUB.INFO";
            $subject = "Cập nhật mật khẩu |  BTCCLUB.INFO";
            $recipient_email = $email;
            $body = $htmlStr;
            $mail = sendMail($subject, $body, $name, $recipient_email);
            if($mail){
                echo 1;
            }
            else{
                echo 2;
            }
        }
        else {
            // Tai khoan khong hop le
            echo 0;
        }
    }
?>