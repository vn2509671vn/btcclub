<?php 
    require("../../config.php");
    function kiemtrastatus($nguoidung_id){
        $query = "select * from nguoidung where nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    function kiemtrapd($nguoidung_id){
        $query = "select * from pd, nguoidung where pd.pd_nguoidung_id = nguoidung.nguoidung_id and pd.pd_nguoidung_id = $nguoidung_id and pd.pd_status NOT IN ('finished')";
        return mysql_query($query);
    }
    
    function kiemtragd($nguoidung_id){
        $query = "select * from gd, nguoidung where gd.gd_nguoidung_id = nguoidung.nguoidung_id and gd.gd_nguoidung_id = $nguoidung_id and gd.gd_status NOT IN ('finished')";
        return mysql_query($query);
    }
    
    function isEnableProvide($nguoidung_id){
        $pd = kiemtrapd($nguoidung_id);
        $gd = kiemtragd($nguoidung_id);
        $status = kiemtrastatus($nguoidung_id);
        if(!$pd || mysql_num_rows($pd) != 0){
            return false;
        }
        if(!$gd || mysql_num_rows($gd) != 0){
            return false;
        }
        if(!$status || mysql_num_rows($status) == 0){
            return false;
        }
        else {
            $status = mysql_fetch_array($status);
            if($status['nguoidung_sopin'] <= 0 ){
                return false;
            }
            if($status['nguoidung_trangthaihoatdong'] != "normal"){
                return false;
            }
        }
        return true;
    }
    
    function isEnableGet($nguoidung_id){
        $pd = kiemtrapd($nguoidung_id);
        $gd = kiemtragd($nguoidung_id);
        $status = kiemtrastatus($nguoidung_id);
        if(!$pd || mysql_num_rows($pd) != 0){
            return false;
        }
        if(!$gd || mysql_num_rows($gd) != 0){
            return false;
        }
        if(!$status || mysql_num_rows($status) == 0){
            return false;
        }
        else {
            $status = mysql_fetch_array($status);
            if($status['nguoidung_sotiennhan'] <= 0 || $status['nguoidung_sotienhoahong'] <= 0){
                return false;
            }
            if(strtolower($status['nguoidung_trangthaihoatdong']) != "normal"){
                return false;
            }
        }
        return true;
    }
    
    function dspdkhoplenh($pd_id, $userID){
        $query = "select transfer_id, transfer_giatri, transfer_time_remain, 
                    transfer_pd_status, transfer_gd_status, b.gd_nguoidung_id, 
                    transfer_ngaytao, c.nguoidung_hoten, a.transfer_magd_id, a.transfer_mapd_id, d.pd_nguoidung_id 
                    from transfer_pd_gd a, gd b , nguoidung c, pd d 
                    where a.transfer_magd_id = b.gd_id 
					and a.transfer_mapd_id = d.pd_id 
                    and b.gd_nguoidung_id = c.nguoidung_id 
                    and a.transfer_mapd_id = $pd_id 
                    and d.pd_nguoidung_id = $userID";
        return mysql_query($query);
    }
    
    function dsgdkhoplenh($gd_id, $userID){
            $query = "SELECT transfer_id, transfer_giatri, transfer_time_remain, transfer_pd_status, transfer_gd_status, b.pd_nguoidung_id, transfer_ngaytao, c.nguoidung_hoten, a.transfer_magd_id, a.transfer_mapd_id, d.gd_nguoidung_id 
                    FROM transfer_pd_gd a, pd b, nguoidung c, gd d 
                    WHERE a.transfer_mapd_id = b.pd_id 
                    AND a.transfer_magd_id = d.gd_id 
                    AND b.pd_nguoidung_id = c.nguoidung_id 
                    and a.transfer_magd_id = $gd_id 
                    and d.gd_nguoidung_id = $userID";
        return mysql_query($query);
    }
    
    function doPDAction($pdid, $action){
        $query = "update transfer_pd_gd set transfer_pd_status = '$action' where transfer_mapd_id = $pdid";
        return mysql_query($query);
    }
    
    function doGDAction($gdid, $action){
        $query = "update transfer_pd_gd set transfer_gd_status = '$action' where transfer_magd_id = $gdid";
        return mysql_query($query);
    }
    
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        if($action == "transfered"){
            $pdid = $_POST['pdid'];
            $transfer = doPDAction($pdid, $action);
            if($transfer){
                echo true;
            }
            else {
                echo false;
            }
        }
        elseif($action == "pdreport"){
            $pdid = $_POST['pdid'];
            $realAction = 'report';
            $report = doPDAction($pdid, $realAction);
            if($report){
                echo true;
            }
            else {
                echo false;
            }
        }
        elseif($action == "confirmed"){
            $gdid = $_POST['gdid'];
            $transfer = doGDAction($gdid, $action);
            if($transfer){
                echo true;
            }
            else {
                echo false;
            }
        }
        elseif($action == "gdreport"){
            $gdid = $_POST['gdid'];
            $realAction = 'report';
            $report = doGDAction($pdid, $realAction);
            if($report){
                echo true;
            }
            else {
                echo false;
            }
        }
    }
?>