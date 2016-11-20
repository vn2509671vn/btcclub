<?php
require("../config.php");
include("class.smtp.php");
include("class.phpmailer.php"); 
include("functions.php");
$magioithieu = $_GET['code'];
$magioithieu = base64_decode($magioithieu);
// check first if record exists
$query = "SELECT * FROM nguoidung WHERE nguoidung_magioithieu = '$magioithieu'";
$getUser = mysql_fetch_array(mysql_query($query));
$userId = $getUser['nguoidung_id'];
$num = mysql_num_rows(mysql_query($query));
if($num>0){
 
    // update the 'verified' field, from 0 to 1 (unverified to verified)
    $mahoamatkhau = md5($magioithieu);
    $query = "UPDATE nguoidung 
                set nguoidung_matkhaudn = '$mahoamatkhau'
                where nguoidung_id=$userId";
    $update = mysql_query($query);
    if($update){           
        // tell the user
        $htmlStr = "";
        $htmlStr .= "Hi " . $email . ",<br /><br />";

        $htmlStr .= "Mật khẩu mới của bạn là: {$magioithieu}.<br /><br /><br />";

        $htmlStr .= "Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi.<br />";
        $htmlStr .= "<a href='https://btcclub.info/' target='_blank'>BTCCLUB.INFO Cho đi, nhận lại - Hệ thống luân chuyển sự giàu có.</a><br />";
        $email = $getUser['nguoidung_mail'];

        $name = "Admin BTCCLUB.INFO";
        $subject = "Cập nhật mật khẩu |  BTCCLUB.INFO";
        $recipient_email = $email;
        $body = $htmlStr;
        $mail = sendMail($subject, $body, $name, $recipient_email);
        if($mail){
            echo "<script> alert('Đã cập nhật thành công mật khẩu. Vui lòng kiểm tra mail để biết mật khẩu mới của bạn là gì nhé!') </script>";
            echo "<script>window.location.replace('../index.php')</script>";
        }
    }else{
        echo "<div> Không thể cập nhật mật khẩu.</div>";
        //print_r($stmt->errorInfo());
    }       
 
}else{
    // tell the user he should not be in this page
    echo "<div>Bạn muốn làm gì khi truy cập như thể nhỉ.</div>";
}
?>