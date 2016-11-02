<?php 
    require("../../config.php");
    function getTotalValue($parentID=null, $gTotal=0){
        // Create the query
        $query = "SELECT * FROM nguoidung WHERE ";
        if($parentID == null) {
            $query .= "nguoidung_parent_id IS NULL";
        }
        else {
            $query .= "nguoidung_parent_id=" . intval($parentID);
        }
        // Execute the query and go through the results.
        $result = mysql_query($query);
        if($result)
        {
            while($row = mysql_fetch_array($result))
            {
                //The current ID;
                $currentID = $row['nguoidung_id'];
                // Sum all children of the current ID
                if($row['nguoidung_sopindadung'] >= 1){
                    $gTotal += 100;
                }
                $gTotal = getTotalValue($currentID, $gTotal);
            }
        }
        return $gTotal;
    }
    
    function getParent($userID, $arrParent){
        $arrTmp = array();
        $arrTmp = $arrParent;
        // Create the query
        $query = "SELECT * FROM nguoidung WHERE nguoidung_id = $userID";
        // Execute the query and go through the results.
        $result = mysql_query($query);
        if($result)
        {
            while($row = mysql_fetch_array($result))
            {
                // The current ID;
                $currentID = $row['nguoidung_parent_id'];
                // Count all parent of the current ID
                if($currentID != NULL){
                    array_push($arrTmp, $currentID);
                }
                $arrTmp = getParent($currentID, $arrTmp);
            }
        }
        return $arrTmp;
    }
    
    function getLeftNode($parentID){
        $query = "select * from nguoidung where nguoidung_parent_id = $parentID and nguoidung_loainhanh = 'L'";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    function getRightNode($parentID){
        $query = "select * from nguoidung where nguoidung_parent_id = $parentID and nguoidung_loainhanh = 'R'";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    function kiemtrastatus($nguoidung_id){
        $query = "select * from nguoidung where nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    function getUserByID($userID){
        $query = "select * from nguoidung where nguoidung_id = $userID";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    function updateCommisson($userID, $giatricanbang, $hoahong){
        $query = "update nguoidung set nguoidung_giatricanbang = $giatricanbang, nguoidung_sotienhoahong = $hoahong where nguoidung_id = $userID";
        return mysql_query($query);
    }
    
    function updateRecommanderCommisson($userID, $hoahong){
        $query = "update nguoidung set nguoidung_sotienhoahong = $hoahong where nguoidung_id = $userID";
        return mysql_query($query);
    }
    
    function getUserByPD($pdid){
        $query = "select nguoidung.*, pd.* from nguoidung, pd where nguoidung.nguoidung_id = pd.pd_nguoidung_id and pd.pd_id = $pdid";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    function getUserByGD($gdid){
        $query = "select nguoidung.*, gd.* from nguoidung, gd where nguoidung.nguoidung_id = gd.gd_nguoidung_id and gd.gd_id = $gdid";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    function kiemtrapd($nguoidung_id){
        $query = "select * from pd, nguoidung where pd.pd_nguoidung_id = nguoidung.nguoidung_id and pd.pd_nguoidung_id = $nguoidung_id and pd.pd_status NOT IN ('finished')";
        return mysql_query($query);
    }
    
    function finishPD($pdid){
        $query = "update pd set pd_status = 'finished' where pd_id = $pdid";
        return mysql_query($query);
    }
    
    function existPDTransfer($pdid){
        $query = "select * from transfer_pd_gd where transfer_mapd_id = $pdid and transfer_pd_status = 'waiting'";
        return mysql_query($query);
    }
    
    function existPD($pdid){
        $query = "select * from pd where pd_id = $pdid and pd_notfilled NOT IN (0)";
        return mysql_query($query);
    }
    
    function kiemtragd($nguoidung_id){
        $query = "select * from gd, nguoidung where gd.gd_nguoidung_id = nguoidung.nguoidung_id and gd.gd_nguoidung_id = $nguoidung_id and gd.gd_status NOT IN ('finished')";
        return mysql_query($query);
    }
    
    function finishGD($gdid){
        $query = "update gd set gd_status = 'finished' where gd_id = $gdid";
        return mysql_query($query);
    }
    
    function existGDTransfer($gdid){
        $query = "select * from transfer_pd_gd where transfer_magd_id = $gdid and transfer_gd_status = 'waiting'";
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
        //$pd = kiemtrapd($nguoidung_id);
        $gd = kiemtragd($nguoidung_id);
        $status = kiemtrastatus($nguoidung_id);
        // if(!$pd || mysql_num_rows($pd) != 0){
        //     return false;
        // }
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
            $query = "SELECT transfer_id, transfer_giatri, transfer_time_remain, transfer_pd_status, transfer_gd_status, b.pd_nguoidung_id, transfer_ngaytao, c.nguoidung_hoten, a.transfer_magd_id, a.transfer_mapd_id, d.gd_nguoidung_id, a.transfer_magd  
                    FROM transfer_pd_gd a, pd b, nguoidung c, gd d 
                    WHERE a.transfer_mapd_id = b.pd_id 
                    AND a.transfer_magd_id = d.gd_id 
                    AND b.pd_nguoidung_id = c.nguoidung_id 
                    and a.transfer_magd_id = $gd_id 
                    and d.gd_nguoidung_id = $userID";
        return mysql_query($query);
    }
    
    function doPDTransfer($pdid, $gdid, $magd, $action, $time){
        $query = "update transfer_pd_gd set transfer_pd_status = '$action', transfer_magd = '$magd', transfer_time_remain = '$time' where transfer_mapd_id = $pdid and transfer_magd_id = $gdid";
        return mysql_query($query);
    }
    
    function doPDReport($pdid, $gdid, $action){
        $query = "update transfer_pd_gd set transfer_pd_status = '$action' where transfer_mapd_id = $pdid and transfer_magd_id = $gdid";
        return mysql_query($query);
    }
    
    function doGDAction($gdid, $pdid, $action){
        $query = "update transfer_pd_gd set transfer_gd_status = '$action' where transfer_magd_id = $gdid and transfer_mapd_id = $pdid";
        return mysql_query($query);
    }
    
    /*Group function for create PD*/
    function createPD($nguoidung_id, $mapd){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO pd(pd_mapd, pd_ngaytao, pd_filled, pd_maxprofit, pd_nguoidung_id, pd_status) VALUES ('$mapd', '$curDate', 100, 150, $nguoidung_id, 'waiting')";
        return mysql_query($query);
    }
    
    function minusPin($nguoidung_id, $sopin, $sopindadung){
        $query = "update nguoidung set nguoidung_sopin = $sopin, nguoidung_sopindadung = $sopindadung where nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    function createHisPin($nguoidung_id, $type, $giatri, $sys_des, $user_des = ''){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO pin(pin_nguoidung_id, pin_transaction_type, pin_giatri, pin_system_description, pin_user_description, pin_ngaytao) VALUES ($nguoidung_id, '$type', '$giatri', '$sys_des', '$user_des','$curDate')";
        return mysql_query($query);
    }
    
    function updateTimePD($nguoidung_id){
        date_default_timezone_set('Asia/Bangkok');
        $time = new DateTime();
        $datetime = $time->modify('+2 day');
        $datetime = $datetime->format('Y-m-d H:i:s');
        $query = "update nguoidung set nguoidung_hankichpd1 = '$datetime' where nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    /*Group function for GD*/
    function addRWallet($nguoidung_id, $tiennhan){
        $query = "update nguoidung set nguoidung_sotiennhan = $tiennhan where nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    /*Group function for Commission History*/
    function addHistoryCommission($nguoidung_id, $money=0, $description=""){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO commission(commission_date, commission_nguoidung_id, commission_value, commission_descript) value('$curDate', $nguoidung_id, $money, '$description')";
        return mysql_query($query);
    }
    
    function getDetailGD($gdid){
        $query = "select * from gd where gd_id = $gdid";
        $result =  mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    /*Function for finish pd-gd*/
    function finishTransfer($transfer_id){
        $query = "update transfer_pd_gd set transfer_status = 'finished' where transfer_id = $transfer_id";
        return mysql_query($query);
    }
    
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        if($action == "transfered"){
            $pdid = $_POST['pdid'];
            $gdid = $_POST['gdid'];
            $magd = $_POST['magd'];
            $time = $_POST['time'];
            $time = new DateTime($time);
            $datetime = $time->modify('+12 hours');
            $datetime = $datetime->format('Y-m-d H:i:s');
            $transfer = doPDTransfer($pdid, $gdid, $magd, $action, $datetime);
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
            $gdid = $_POST['gdid'];
            $report = doPDReport($pdid, $gdid, $realAction);
            if($report){
                echo true;
            }
            else {
                echo false;
            }
        }
        elseif($action == "confirmed"){
            $gdid = $_POST['gdid'];
            $pdid = $_POST['pdid'];
            $transferid = $_POST['transferid'];
            $okPD = false;
            $okGD = false;
            $okFinish = false;
            $userPD = getUserByPD($pdid);
            $userGD = getUserByGD($gdid);
            $gdDetail = getDetailGD($gdid);
            $transfer = doGDAction($gdid, $pdid, $action);
            
            /*Execute for GD to PD*/
            if($userGD['nguoidung_sopin'] > 0 && $userGD['nguoidung_hethong'] != 1 && $gdDetail['gd_mathuong'] != 1){
                $mapd = 'PD'.$userGD['nguoidung_id'].date("YmdHs");
                $pin = $userGD['nguoidung_sopin'] - 1;
                $pinused = $userGD['nguoidung_sopindadung'] + 1;
                $isPD = createPD($userGD['nguoidung_id'], $mapd);
                $isMinusPin = minusPin($userGD['nguoidung_id'], $pin, $pinused);
                $isCreateHisPin = createHisPin($userGD['nguoidung_id'], 'PD', -1, 'Used PIN for PD['.$mapd.']');
                if($isPD && $isMinusPin && $isCreateHisPin){
                    $okGD = true;
                }
            }
            else {
                $okGD = true;
            }
            
            /*Execute for PD to GD*/
            if($userPD['nguoidung_sopindadung'] <= 1){
                if($userPD['nguoidung_sopin'] > 0){
                    $mapd = 'PD'.$userPD['nguoidung_id'].date("YmdHs");
                    $pin = $userPD['nguoidung_sopin'] - 1;
                    $pinused = $userPD['nguoidung_sopindadung'] + 1;
                    $isPD = createPD($userPD['nguoidung_id'], $mapd);
                    $isMinusPin = minusPin($userPD['nguoidung_id'], $pin, $pinused);
                    $isCreateHisPin = createHisPin($userPD['nguoidung_id'], 'PD', -1, 'Used PIN for PD['.$mapd.']');
                    
                    if($isPD && $isMinusPin && $isCreateHisPin){
                        $okPD = true;
                    }
                }
                else {
                    updateTimePD($userPD['nguoidung_id']);
                    $okPD = true;
                }
            }
            else {
                $rWallet = $userPD['nguoidung_sotiennhan'] + 150;
                $addWallet = addRWallet($userPD['nguoidung_id'], $rWallet);
                if($addWallet){
                    $okPD = true;
                }
            }
            
            /*Finish for pd-gd*/
            if($okGD && $okPD){
                $transferFinish = finishTransfer($transferid);
                $existPDTransfer = existPDTransfer($pdid);
                $existPD = existPD($pdid);
                $existGDTransfer = existGDTransfer($gdid);
                if(mysql_num_rows($existPDTransfer) == 0 && mysql_num_rows($existPD) == 0){
                    $pdFinish = finishPD($pdid);
                }
                
                if(mysql_num_rows($existGDTransfer) == 0){
                    $gdFinish = finishGD($gdid);
                }
            }
            
            /*Add Commission*/
            if($userPD['nguoidung_sopindadung'] == 1){
                /*Add commission for recommender*/
                $recommenderID = $userPD['nguoidung_gioithieu'];
                $recommender = getUserByID($recommenderID);
                if($recommender['nguoidung_sopindadung'] > 1){
                    $recommenderCommission = $recommender['nguoidung_sotienhoahong'] + 10;
                    $updateRecommenderCommission = updateRecommanderCommisson($recommenderID, $recommenderCommission);
                    if($updateRecommenderCommission){
                        addHistoryCommission($recommenderID, $recommenderCommission, 'Hoa hồng trực tiếp');
                    }
                }
                
                /*Add commission for weak team*/
                $arrParent = array();
                $arrParent = getParent($userPD['nguoidung_id'], $arrParent);
                foreach ($arrParent as $parentId) {
                    $root = getUserByID($parentId);
                    if($root['nguoidung_sopindadung'] <= 1){
                        continue;
                    }
                    $nodeL = getLeftNode($parentId);
                    $nodeR = getRightNode($parentId);
                    $totalL = 0;
                    $totalR = 0;
                    $tiencanbang = 0;
                    $totalL = getTotalValue($nodeL['nguoidung_id'], $totalL);
                    $totalR = getTotalValue($nodeR['nguoidung_id'], $totalR);
                    if($nodeL['nguoidung_sopindadung'] >= 1){
                        $totalL += 100;
                    }
                    
                    if($nodeR['nguoidung_sopindadung'] >= 1){
                        $totalR += 100;
                    }
                    
                    $tiencanbang = min($totalL,$totalR);
                    $giatricanbang = $root['nguoidung_giatricanbang'];
                    if($tiencanbang != 0 && $tiencanbang > $giatricanbang){
                        $hoahong = $root['nguoidung_sotienhoahong'] + ($tiencanbang - $giatricanbang)*$root['nguoidung_phantramhoahong'];
                        $giatricanbang = $tiencanbang;
                        $updateCommission = updateCommisson($root['nguoidung_id'], $giatricanbang, $hoahong);
                        if($updateCommission){
                            addHistoryCommission($root['nguoidung_id'], $hoahong, 'Hoa hồng nhánh yếu');
                        }
                    }
                }
            }
            
            if($transferFinish && $transfer){
                echo true;
            }
            else {
                echo false;
            }
        }
        elseif($action == "gdreport"){
            $gdid = $_POST['gdid'];
            $pdid = $_POST['pdid'];
            $realAction = 'report';
            $report = doGDAction($gdid, $pdid, $realAction);
            if($report){
                echo true;
            }
            else {
                echo false;
            }
        }
    }
?>