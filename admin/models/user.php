<?php 
    require("../../user/models/pd-gd.php");
    function getVirtualUserNotBusy(){
        $query = "select * from nguoidung where nguoidung_hethong = 1 and nguoidung_quyen = 'normal' and nguoidung_id NOT IN (select gd_nguoidung_id from gd where gd_status IN ('waiting','matched'))";
        return mysql_query($query);
    }
    
    function getVirtualUserWaiting(){
        $query = "select * from nguoidung where nguoidung_hethong = 1 and nguoidung_quyen = 'normal' and nguoidung_id IN (select gd_nguoidung_id from gd where gd_status = 'waiting')";
        return mysql_query($query);
    }
    
    function getVirtualUserBusy(){
        $query = "select nguoidung.*, gd.*, transfer_pd_gd.* from nguoidung, gd, transfer_pd_gd 
                where nguoidung.nguoidung_hethong = 1 
                and nguoidung.nguoidung_quyen = 'normal' 
                and gd.gd_nguoidung_id = nguoidung.nguoidung_id 
                and gd.gd_id = transfer_pd_gd.transfer_magd_id 
                and transfer_pd_gd.transfer_status = 'waiting'";
        return mysql_query($query);
    }
    
    function createGDForVirtualUser($nguoidung_id, $magd, $sotien){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO gd(gd_magd, gd_ngaytao, gd_giatri, gd_nguoidung_id, gd_status) VALUES ('$magd', '$curDate', $sotien, $nguoidung_id, 'waiting')";
        return mysql_query($query);
    }
    
    function getAccountByPD($pdid){
        $query = "select * from nguoidung, pd where nguoidung.nguoidung_id = pd.pd_nguoidung_id and pd.pd_id = $pdid";
        $result = mysql_query($query);
        $user = mysql_fetch_array($result);
        return $user['nguoidung_taikhoan'];
    }
    
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        if($action == 'createGD'){
            $id = $_POST['userID'];
            $wallet = $_POST['wallet'];
            $magd = $_POST['magd'];
            $isTaolenh = createGDForVirtualUser($id, $magd, $wallet);
            if($isTaolenh){
                echo 1;
            }
            else {
                echo 0;
            }
        }
        
    }
?>