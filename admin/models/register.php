<?php
require("../../config.php");
    
    function createUser($nguoidung_taikhoan, $nguoidung_gioithieu, $nguoidung_parent_id, $nguoidung_matkhaudn, $nguoidung_matkhaugd
                        , $nguoidung_hoten, $nguoidung_sdt, $nguoidung_mail, $nguoidung_diachi, $nguoidung_btclink){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO nguoidung(nguoidung_taikhoan, nguoidung_matkhaudn, nguoidung_matkhaugd,nguoidung_hoten, nguoidung_sdt, 
            nguoidung_mail, nguoidung_diachi, nguoidung_btclink, nguoidung_gioithieu,nguoidung_parent_id, nguoidung_trangthaikichhoat, nguoidung_hankichpd1, 
            nguoidung_dakichpd1, nguoidung_trangthaihoatdong, nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan, nguoidung_capbac,
            nguoidung_sopin, nguoidung_sopindadung, nguoidung_sotiennhan, nguoidung_sotienhoahong, nguoidung_soluongthanhvien)
            VALUES ('$nguoidung_taikhoan','$nguoidung_matkhaudn','$nguoidung_matkhaugd','$nguoidung_hoten','$nguoidung_sdt',
            '$nguoidung_mail','$nguoidung_diachi','$nguoidung_btclink',$nguoidung_gioithieu,$nguoidung_parent_id,'new','0000-00-00 00:00:00',
            0,'normal','normal','$curDate',1,'j0',0,0,0,0,0)";
        return mysql_query($query);
    }
    

if ($_POST) {
    $nguoidung_taikhoan = $_POST['nguoidung_taikhoan'];
    $nguoidung_gioithieu = $_POST['nguoidung_gioithieu'];
    $nguoidung_parent_id = $_POST['nguoidung_parent_id'];
    $nguoidung_matkhaudn = $_POST['nguoidung_matkhaudn'];
        $nguoidung_matkhaudn = md5($nguoidung_matkhaudn);
    $nguoidung_matkhaugd = $_POST['nguoidung_matkhaugd'];  
        $nguoidung_matkhaugd = md5($nguoidung_matkhaugd);
    $nguoidung_hoten = $_POST['nguoidung_hoten'];
    $nguoidung_sdt = $_POST['nguoidung_sdt'];
    $nguoidung_mail = $_POST['nguoidung_mail'];
    $nguoidung_diachi = $_POST['nguoidung_diachi'];
    $nguoidung_btclink = $_POST['nguoidung_btclink'];
    
    try 
    {
        $isCreate = createUser($nguoidung_taikhoan, $nguoidung_gioithieu, $nguoidung_parent_id, $nguoidung_matkhaudn, $nguoidung_matkhaugd
                        , $nguoidung_hoten, $nguoidung_sdt, $nguoidung_mail, $nguoidung_diachi, $nguoidung_btclink);
        
        if ($isCreate) {
            echo "Successfully Added";
        } else {
            echo "Query Problem";
        }

    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

?>