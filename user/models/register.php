<?php
require("../../config.php");
    
    function createUser($nguoidung_taikhoan, $nguoidung_matkhaudn, $nguoidung_matkhaugd
                        , $nguoidung_hoten, $nguoidung_sdt, $nguoidung_mail, $nguoidung_diachi, $nguoidung_btclink,
                        $nguoidung_gioithieu, $nguoidung_parent_id, $nguoidung_loainhanh){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO nguoidung(nguoidung_taikhoan, nguoidung_matkhaudn, nguoidung_matkhaugd, nguoidung_hoten, nguoidung_sdt,
                nguoidung_mail, nguoidung_diachi, nguoidung_btclink, nguoidung_gioithieu, nguoidung_parent_id,
                nguoidung_loainhanh, nguoidung_giatricanbang, nguoidung_phantramhoahong, nguoidung_trangthaikichhoat, nguoidung_hankichpd1, 
                nguoidung_dakichpd1, nguoidung_trangthaihoatdong, nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan, nguoidung_capbac, 
                nguoidung_sopin, nguoidung_sopindadung, nguoidung_sotiennhan, nguoidung_sotienhoahong, nguoidung_soluongthanhvien)
            VALUES ('$nguoidung_taikhoan','$nguoidung_matkhaudn','$nguoidung_matkhaugd','$nguoidung_hoten','$nguoidung_sdt',
            '$nguoidung_mail','$nguoidung_diachi','$nguoidung_btclink',$nguoidung_gioithieu,$nguoidung_parent_id,'$nguoidung_loainhanh',0,0,'new',
            '0000-00-00 00:00:00',0,'normal','normal','$curDate',1,'j0',0,0,0,0,0)";
        return mysql_query($query);
    }
    function checkCapbac($id){
        $query = "select nguoidung_id from nguoidung where nguoidung_gioithieu=$id";
        return mysql_query($query);
    }
    function updateCapbac($id,$capbac,$phantramhoahong){
        $query = "update nguoidung set nguoidung_capbac='$capbac' , nguoidung_phantramhoahong= $phantramhoahong where nguoidung_id=$id";
        return mysql_query($query);
    }
    function checknhanh($id){
        $query = "select nguoidung_id, nguoidung_loainhanh from nguoidung where nguoidung_parent_id=$id";
        $nhanh = mysql_query($query);
        $lstnhanh = mysql_fetch_array($nhanh);
        $loainhanh = '';
        if($lstnhanh['nguoidung_loainhanh'] == 'L'){
            $loainhanh = 'R';
        }
        else $loainhanh = 'L';
        return $loainhanh;
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
        $nguoidung_loainhanh = checknhanh($nguoidung_parent_id);
        $isCreate = createUser($nguoidung_taikhoan, $nguoidung_matkhaudn, $nguoidung_matkhaugd, $nguoidung_hoten, $nguoidung_sdt, $nguoidung_mail, $nguoidung_diachi, $nguoidung_btclink,$nguoidung_gioithieu, $nguoidung_parent_id, $nguoidung_loainhanh);
        $checkcapbac = checkCapbac($nguoidung_gioithieu);
        $coutf1 = mysql_num_rows($checkcapbac);
        if($coutf1 < 5){
            $isUpdate = updateCapbac($nguoidung_gioithieu,'j0',0);
        }
        else if($coutf1 < 10){
            $isUpdate = updateCapbac($nguoidung_gioithieu,'j1',1);
        }
        else if($coutf1 < 20){
            $isUpdate = updateCapbac($nguoidung_gioithieu,'j2',3);
        }
        else if($coutf1 < 30){
            $isUpdate = updateCapbac($nguoidung_gioithieu,'j3',5);
        }
        else if($coutf1 >= 30){
            $isUpdate = updateCapbac($nguoidung_gioithieu,'f4',10);
        }
        if ($isCreate && $isUpdate) {
            echo "Successfully Added";
        }
        else {
            echo "Query Problem";
        }

    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

?>