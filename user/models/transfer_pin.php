<?php 
    require("../../config.php");
    function taolichsupin($nguoidung_id, $type, $giatri, $sys_des, $user_des){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO pin(pin_nguoidung_id, pin_transaction_type, pin_giatri, pin_system_description, pin_user_description, pin_ngaytao) VALUES ($nguoidung_id, '$type', '$giatri', '$sys_des', '$user_des','$curDate')";
        return mysql_query($query);
    }
    
    function getIDByUserName($userName){
        $query = "select * from nguoidung where nguoidung_taikhoan = '$userName'";
        return mysql_query($query);
    }
    
    function updatepin($id,$sopin){
        $query = "update nguoidung set nguoidung_sopin = $sopin where nguoidung_id = $id";
        return mysql_query($query);
    }
    function sttaccount($id){
        $query = "select * from nguoidung nd where nd.nguoidung_id=" . $id;
        return mysql_fetch_array(mysql_query($query));
    }
    function getmk($id){
        $query = "select nguoidung_matkhaugd from nguoidung where nguoidung_id=" . $id;
        return mysql_fetch_array(mysql_query($query));
    }
    function getSopin($id){
        $query = "select nguoidung_sopin from nguoidung where nguoidung_id=" .$id;
        return mysql_fetch_array(mysql_query($query));
    }
    if(isset($_POST['action'])){
        $id = $_POST['idchuyen'];
        $sopin = $_POST['sopinchuyen'];
        $amount = $_POST['amount'];
        $sopin = $sopin -  $amount;
        
        $gioithieu = $_POST['gioithieu'];
        $getUser = getIDByUserName($gioithieu);
        if(mysql_num_rows($getUser) > 0){
            $user = mysql_fetch_array($getUser);
            $gioithieuID = $user['nguoidung_id'];
        }
        else {
            $gioithieuID = "";
        }
        
        if($gioithieuID != ""){
            $lstsopin_nhan = getSopin($gioithieuID);
            $sopin_nhan = $lstsopin_nhan['nguoidung_sopin'];
            $sopin_nhan = $sopin_nhan + $amount;
            $lstmapd = sttaccount($gioithieuID);
            $mapd = $lstmapd['nguoidung_taikhoan'];
            $nguoichuyen = sttaccount($id);
            $noidung = $_POST['noidung'];
            $mk = $_POST['mk'];
            $mk = stripslashes($mk);
            $mk = mysql_real_escape_string($mk);
            $mk = md5($mk);
            $lstmk_chungthuc = getmk($id);
            $mk_temp = $lstmk_chungthuc['nguoidung_matkhaugd'];
            $mk_temp = stripslashes($mk_temp);
            $mk_temp = mysql_real_escape_string($mk_temp);
            $nguoicho_description = 'Used PIN for [' . $mapd . ']';
            $nguoinhan_description = 'Recieved PIN From [' . $nguoichuyen['nguoidung_taikhoan'] .']';
            if(strcasecmp($mk,$mk_temp)==0)
            {
                $isTrupin = updatepin($id, $sopin);
                $isCongpin = updatepin($gioithieuID,$sopin_nhan);
                $isLichSuCho = taolichsupin($id, 'PIN Transfer', 0-$amount, $nguoicho_description,'');
                $isLichSuNhan = taolichsupin($gioithieuID, 'PIN Transfer', $amount, $nguoinhan_description, $noidung );
                echo 1;
            }
            else{
                echo 0;
            }
        }
        else {
            echo 2;
        }
    }
?>