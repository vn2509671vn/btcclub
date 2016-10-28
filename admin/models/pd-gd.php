<?php 
    require("../../config.php");
    function danhsachpd(){
        $query = "select pd.*, nguoidung.* from pd, nguoidung where pd.pd_nguoidung_id = nguoidung.nguoidung_id and pd.pd_notfilled != 0 ORDER BY pd.pd_ngaytao ASC";
        return mysql_query($query);
    }
    
    function danhsachgd(){
        $query = "select gd.*, nguoidung.* from gd, nguoidung where gd.gd_nguoidung_id = nguoidung.nguoidung_id and gd.gd_status = 'waiting' ORDER BY gd.gd_ngaytao ASC";
        return mysql_query($query);
    }
    
    function khoplenh($matransfer, $pdid, $gdid, $sotien){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $timeRemain = $datetime->modify('+2 day');
        $timeRemain = $timeRemain->modify('+12 hours');
        $timeRemain = $timeRemain->format('Y-m-d H:i:s');
        $query = "insert into transfer_pd_gd(transfer_magd, transfer_ngaytao, transfer_mapd_id, transfer_magd_id, transfer_giatri, transfer_time_remain, transfer_status, transfer_pd_status, transfer_gd_status) 
        value('$matransfer', '$curDate', $pdid, $gdid, $sotien, '$timeRemain', 'waiting', 'waiting', 'waiting')";
        return mysql_query($query);
    }
    
    function updatePDStatus($pdid, $status, $pd_chuacho){
        $query = "update pd set pd_status = '$status', pd_notfilled = $pd_chuacho where pd_id = $pdid";
        return mysql_query($query);
    }
    
    function updateGDStatus($gdid, $status){
        $query = "update gd set gd_status = '$status' where gd_id = $gdid";
        return mysql_query($query);
    }
    
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        if($action == 'khoplenh'){
            $pdid = $_POST['pdid'];
            $gdid = $_POST['gdid'];
            $sotien = $_POST['sotien'];
            $pd_chuacho = $_POST['pd_chuacho'];
            $matransfer = $_POST['matransfer'];
            $statusPD = updatePDStatus($pdid, 'matched', $pd_chuacho);
            $statusGD = updateGDStatus($gdid, 'matched');
            $isKhopLenh = khoplenh($matransfer, $pdid, $gdid, $sotien);
            if($statusPD && $statusGD && $isKhopLenh){
                echo true;
            }
            else {
                echo false;
            }
        }
    }
?>