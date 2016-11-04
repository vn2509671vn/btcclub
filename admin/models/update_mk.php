<?php
require("../../config.php");
    
    function upMatkhaudn($id, $nguoidung_matkhaudn){
        $query = "UPDATE nguoidung SET nguoidung_matkhaudn = '$nguoidung_matkhaudn' WHERE nguoidung_id=$id";
        return mysql_query($query);
    }
    function upMatkhaugd($id, $nguoidung_matkhaugd){
        $query = "UPDATE nguoidung SET nguoidung_matkhaugd = '$nguoidung_matkhaugd' WHERE nguoidung_id=$id";
        return mysql_query($query);
    }
    $ketquaupdate = "";

if ($_POST) {
    $id=$_POST['id'];
    $nguoidung_matkhaudn = $_POST['nguoidung_matkhaudn'];
    $nguoidung_matkhaudn = stripslashes($nguoidung_matkhaudn);
    $nguoidung_matkhaudn = mysql_real_escape_string($nguoidung_matkhaudn) . '';
    
    $nguoidung_matkhaudn_repeat = $_POST['nguoidung_matkhaudn_repeat'];
    $nguoidung_matkhaudn_repeat = stripslashes($nguoidung_matkhaudn_repeat);
    $nguoidung_matkhaudn_repeat = mysql_real_escape_string($nguoidung_matkhaudn_repeat) . '';
  
    $nguoidung_matkhaugd = $_POST['nguoidung_matkhaugd'];
    $nguoidung_matkhaugd = stripslashes($nguoidung_matkhaugd);
    $nguoidung_matkhaugd = mysql_real_escape_string($nguoidung_matkhaugd) . '';
    
    $nguoidung_matkhaugd_repeat = $_POST['nguoidung_matkhaugd_repeat'];
    $nguoidung_matkhaugd_repeat = stripslashes($nguoidung_matkhaugd_repeat);
    $nguoidung_matkhaugd_repeat = mysql_real_escape_string($nguoidung_matkhaugd_repeat) . '';
    
    try 
    {
        if($_POST['nguoidung_matkhaudn'] && isset($_POST['nguoidung_matkhaudn'])){
            if(strcasecmp($nguoidung_matkhaudn,$nguoidung_matkhaudn_repeat) == 0)
            {
                
                $nguoidung_matkhaudn = md5($nguoidung_matkhaudn);
                $isUpdn = upMatkhaudn($id, $nguoidung_matkhaudn);
                if ($isUpdn) {
                    $ketquaupdate =  $ketquaupdate  . "Đã cập nhật thành công mật khẩu đăng nhập. ";
                } else {
                    $ketquaupdate = $ketquaupdate . "Không thể cập nhật thành công mật khẩu đăng nhập. Vui lòng nhập lại mật khẩu. ";
                }
            }
            else{
                $ketquaupdate = $ketquaupdate . "Mật khẩu đăng nhập không khớp. ";
            }
        }
        if($_POST['nguoidung_matkhaugd'] && isset($_POST['nguoidung_matkhaugd'])){
            if(strcasecmp($nguoidung_matkhaugd, $nguoidung_matkhaugd_repeat) == 0)
            {
                $nguoidung_matkhaugd = md5($nguoidung_matkhaugd);
                $isUpgd = upMatkhaugd($id, $nguoidung_matkhaugd);
                if ($isUpgd) {
                    $ketquaupdate = $ketquaupdate . "Đã cập nhật thành công mật khẩu đăng nhập. ";
                } else {
                    $ketquaupdate = $ketquaupdate . "Không thể cập nhật thành công mật khẩu đăng nhập. Vui lòng nhập lại mật khẩu. ";
                }
            }
            else{
                $ketquaupdate = $ketquaupdate . "Mật khẩu giao dịch không khớp. ";
            }
        }
        echo $ketquaupdate;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

?>