<?php 
    require("../../config.php");
    
    function getListTransferWaiting(){
        $query = "select transfer.*, nguoidungPD.nguoidung_taikhoan as 'PDName', nguoidungGD.nguoidung_taikhoan as 'GDName' from transfer_pd_gd transfer, pd, gd, nguoidung nguoidungPD, nguoidung nguoidungGD 
        where transfer.transfer_status = 'waiting' 
        and transfer.transfer_mapd_id = pd.pd_id 
        and transfer.transfer_magd_id = gd.gd_id 
        and gd.gd_nguoidung_id = nguoidungGD.nguoidung_id 
        and pd.pd_nguoidung_id = nguoidungPD.nguoidung_id";
        return mysql_query($query);
    }
    
    function getPDInfo($pdid){
        $query = "select * from pd where pd_id = $pdid";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    function updatePDStatus($pdid, $status, $pd_chuacho){
        $query = "update pd set pd_status = '$status', pd_notfilled = $pd_chuacho where pd_id = $pdid";
        return mysql_query($query);
    }
    
    function updateGDStatus($gdid, $status, $amount){
		if($amount != 0){
			$query = "update gd set gd_status = '$status', gd_giatri = $amount where gd_id = $gdid";
		}
		else {
			$query = "update gd set gd_status = '$status' where gd_id = $gdid";
		}
        return mysql_query($query);
    }
    
    function updateTransferStatus($transferid, $status){
        $query = "update transfer_pd_gd set transfer_status = '$status' where transfer_id = $transferid";
        return mysql_query($query);
    }
    
    function existPDTransfer($pdid){
        $query = "select * from transfer_pd_gd where transfer_mapd_id = $pdid and transfer_status = 'waiting'";
        return mysql_query($query);
    }
    
    function existGDTransfer($gdid){
        $query = "select * from transfer_pd_gd where transfer_magd_id = $gdid and transfer_status = 'waiting'";
        return mysql_query($query);
    }
    
    function proceedTransferReport($pdId, $pdStatus, $gdId, $gdStatus, $transferID, $amount){
        /*Recover trade status when pd report*/
        if($pdStatus == 'report'){
            // 1. Trả lại pd_notfilled = pd_notfilled + amount
            // 2. Neu pd_notfilled sau khi tra lai = 100 thi chuyen trang thai pd thanh waiting
            // 3. Cap nhat trang thai gd thanh finished
            // 3. Cap nhat transfer_status = finished
            $pdInfo = getPDInfo($pdId);
            $Filled = $pdInfo['pd_notfilled'] + $amount;
            if($Filled == 100){
                $updatePD = updatePDStatus($pdId, 'waiting', $Filled);
            }
            else {
                $updatePD = updatePDStatus($pdId, 'matched', $Filled);
            }
            
            $updateGD = updateGDStatus($gdId, 'finished', 0);
            $updateTransfer = updateTransferStatus($transferID, 'finished');
            if($updatePD && $updateGD && $updateTransfer){
                return true;
            }
            else {
                return false;
            }
        }
        
        /*Recover trade status when gd report*/
        elseif($gdStatus == 'report'){
            // 1. Cap nhat trang thai gd thanh waiting
            // 2. Cap nhat transfer_status = finished
            // 3. Chuyen trang thai pd thanh finished
            $updateGD = updateGDStatus($gdId, 'waiting', $amount);
            $updateTransfer = updateTransferStatus($transferID, 'finished');
            $pdInfo = getPDInfo($pdId);
            $Filled = $pdInfo['pd_notfilled'] + $amount;
            if($Filled == 100){
                $updatePD = updatePDStatus($pdId, 'finished', $Filled);
            }
            else {
                $updatePD = updatePDStatus($pdId, 'matched', $Filled);
            }
            
            if($updatePD && $updateGD && $updateTransfer){
                return true;
            }
            else {
                return false;
            }
        }
    }
    
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        if($action == 'proceedTransfer'){
            $pdID = $_POST['pdId'];
            $pdStatus = $_POST['pdStatus'];
            $gdId = $_POST['gdId'];
            $gdStatus = $_POST['gdStatus'];
            $transferID = $_POST['transferID'];
            $amount = $_POST['amount'];
            
            $doProceed = proceedTransferReport($pdID, $pdStatus, $gdId, $gdStatus, $transferID, $amount);
            if($doProceed){
                echo 1;
            }
            else {
                echo 0;
            }
        }
    }
?>