<?php 
    require("../../config.php");
    function danhsachpd($nguoidung_id){
        $query = "select pd.pd_id, pd.pd_mapd, pd.pd_ngaytao, pd.pd_filled, pd.pd_maxprofit, pd.pd_status, nguoidung.nguoidung_taikhoan as 'taikhoan' from pd, nguoidung where pd.pd_nguoidung_id = nguoidung.nguoidung_id and pd.pd_nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    function trupin($nguoidung_id, $sopin, $status, $sopindadung){
        $query = "update nguoidung set nguoidung_sopin = $sopin, nguoidung_trangthaikichhoat = '$status', nguoidung_sopindadung = $sopindadung, nguoidung_dakichpd1 = 1 where nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    function taolichsupin($nguoidung_id, $type, $giatri, $sys_des, $user_des = ''){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO pin(pin_nguoidung_id, pin_transaction_type, pin_giatri, pin_system_description, pin_user_description, pin_ngaytao) VALUES ($nguoidung_id, '$type', '$giatri', '$sys_des', '$user_des','$curDate')";
        return mysql_query($query);
    }
    
    function taolenhpd($nguoidung_id, $mapd){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO pd(pd_mapd, pd_ngaytao, pd_filled, pd_maxprofit, pd_nguoidung_id, pd_status) VALUES ('$mapd', '$curDate', 100, 150, $nguoidung_id, 'waiting')";
        return mysql_query($query);
    }
    
    if(isset($_POST['action'])){
        $id = $_POST['id'];
        $sopin = $_POST['sopin'];
        $sopindadung = $_POST['sopindadung'];
        $mapd = $_POST['mapd'];
        $status = $_POST['status'];
        $isTrupin = trupin($id, $sopin, $status, $sopindadung);
        $isLichSu = taolichsupin($id, 'PD', -1, 'Used PIN for PD['.$mapd.']');
        $isTaolenh = taolenhpd($id,$mapd);
        if($isTrupin && $isTaolenh && $isLichSu){
            echo true;
        }
        else {
            echo false;
        }
    }
?>