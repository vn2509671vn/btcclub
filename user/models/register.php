<?php
require("../../config.php");
    
    function createUser($nguoidung_taikhoan, $nguoidung_matkhaudn, $nguoidung_matkhaugd
                        , $nguoidung_hoten, $nguoidung_sdt, $nguoidung_cmnd, $nguoidung_mail, $nguoidung_diachi, $nguoidung_btclink,
                        $nguoidung_gioithieu, $nguoidung_parent_id, $nguoidung_loainhanh){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO nguoidung(nguoidung_taikhoan, nguoidung_matkhaudn, nguoidung_matkhaugd, nguoidung_hoten
		, nguoidung_sdt, nguoidung_cmnd, nguoidung_mail, nguoidung_diachi, nguoidung_btclink, nguoidung_gioithieu
		, nguoidung_parent_id, nguoidung_loainhanh, nguoidung_giatricanbang, nguoidung_phantramhoahong, nguoidung_trangthaikichhoat
		, nguoidung_hankichpd1, nguoidung_dakichpd1, nguoidung_trangthaihoatdong, nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan
		, nguoidung_capbac, nguoidung_sopin, nguoidung_sopindadung, nguoidung_sotiennhan, nguoidung_sotienhoahong, nguoidung_hethong
		, nguoidung_magioithieu, nguoidung_danhanthuong)
	VALUES ('$nguoidung_taikhoan','$nguoidung_matkhaudn','$nguoidung_matkhaugd','$nguoidung_hoten','$nguoidung_sdt','$nguoidung_cmnd','$nguoidung_mail','$nguoidung_diachi'
		,'$nguoidung_btclink',$nguoidung_gioithieu,$nguoidung_parent_id,'$nguoidung_loainhanh'
		,0,0,'new','0000-00-00 00:00:00',0,'normal','normal','$curDate',1,'j0',0,0,0,0,0,'',0)";
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
    function kiemtratrungnhanh($id){
        $query = "select nguoidung_id, nguoidung_loainhanh from nguoidung where nguoidung_parent_id=$id";
        return mysql_query($query);
    }
    
    function checknhanh($id){
        $query = "select nguoidung_id, nguoidung_loainhanh from nguoidung where nguoidung_parent_id=$id";
        $nhanh = mysql_query($query);
        $lstnhanh = mysql_fetch_array($nhanh);
        $loainhanh = '';
        if(mysql_num_rows($nhanh) > 0)
        {
            if($lstnhanh['nguoidung_loainhanh'] == 'L'){
                $loainhanh = 'R';
            }
            else {
                $loainhanh = 'L';
            }
        }
        else{
            $loainhanh = 'L';
        }
        return $loainhanh;
    }
    function getid($nguoidung_taikhoan){
        $query = "select nguoidung_id from nguoidung where nguoidung_taikhoan = '$nguoidung_taikhoan'";
        return mysql_fetch_array(mysql_query($query));
    }
    
    function updateMagioithieu($id,$nguoidung_magioithieu){
        $query = "update nguoidung set nguoidung_magioithieu='$nguoidung_magioithieu' where nguoidung_id=$id";
        return mysql_query($query);
    }
    function checktaikhoan($nguoidung_taikhoan){
        $query = "select nguoidung_taikhoan from nguoidung where nguoidung_taikhoan = '$nguoidung_taikhoan'";
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
    $nguoidung_cmnd = $_POST['nguoidung_cmnd'];
    $nguoidung_taikhoan_ck = mysql_num_rows(checktaikhoan($nguoidung_taikhoan));
    $kiemtraNhanh = kiemtratrungnhanh($nguoidung_parent_id);
    $countNhanh = mysql_num_rows($kiemtraNhanh);
    try 
    {
        if($nguoidung_taikhoan_ck < 1 )
        {
            if($countNhanh < 2){
                
                $nguoidung_loainhanh = checknhanh($nguoidung_parent_id);
                $isCreate = createUser($nguoidung_taikhoan, $nguoidung_matkhaudn, $nguoidung_matkhaugd, $nguoidung_hoten, $nguoidung_sdt, $nguoidung_cmnd, $nguoidung_mail, $nguoidung_diachi, $nguoidung_btclink,$nguoidung_gioithieu, $nguoidung_parent_id, $nguoidung_loainhanh);
                $lstID = getid($nguoidung_taikhoan);
                $UserID = $lstID['nguoidung_id'];
                $datetime_GT = new DateTime();
                $curDate_GT = $datetime_GT->format('YmdHs');
                $nguoidung_magioithieu = $UserID . $curDate_GT;
                $isUpdateMaGioiThieu = updateMagioithieu($UserID,$nguoidung_magioithieu);
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
                
                if ($isCreate && $isUpdateMaGioiThieu && $isUpdate) {
                    echo "Successfully Added";
                }
                else {
                    echo "Query Problem";
                }
            }
            else{
                echo "Bạn không thể chọn người quản lí này. Yêu cầu refresh lại trang.";
            }
        }
        else{
            echo "Tài Khoản đã được tạo";
        }
        

    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

?>