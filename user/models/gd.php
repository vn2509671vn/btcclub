<?php 
    require("../../config.php");
    
    function danhsachgd($nguoidung_id){
        $query = "select gd.gd_id, gd.gd_magd, gd.gd_ngaytao, gd.gd_giatri, gd.gd_status, nguoidung.nguoidung_taikhoan as 'taikhoan' from gd, nguoidung where gd.gd_nguoidung_id = nguoidung.nguoidung_id and gd.gd_nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    function ruttien($nguoidung_id, $sotiennhan, $sotienhoahong){
        $query = "update nguoidung set nguoidung_sotiennhan = $sotiennhan, nguoidung_sotienhoahong = $sotienhoahong where nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
    
    function taolenhgd($nguoidung_id, $magd, $sotien){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO gd(gd_magd, gd_ngaytao, gd_giatri, gd_nguoidung_id, gd_status) VALUES ('$magd', '$curDate', $sotien, $nguoidung_id, 'waiting')";
        return mysql_query($query);
    }
    
    function createGDCoupon($nguoidung_id, $magd, $sotien){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO gd(gd_magd, gd_ngaytao, gd_giatri, gd_nguoidung_id, gd_status, gd_mathuong) VALUES ('$magd', '$curDate', $sotien, $nguoidung_id, 'waiting', 1)";
        return mysql_query($query);
    }
    
    function kiemtramk2($id){
        $query = "select * from nguoidung where nguoidung_id=$id";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    function updateGetCoupon($userID){
        $query = "update nguoidung set nguoidung_danhanthuong = 1 where nguoidung_id = $userID";
        return mysql_query($query);
    }
    
    function getListF1($userID){
        $query = "select * from nguoidung where nguoidung_gioithieu = $userID and nguoidung_sopindadung > 0";
        return mysql_query($query);
    }
    
    if(isset($_POST['action'])){
        $action = $_POST['action'];
        if($action == 'create'){
            $id = $_POST['userid'];
            $matkhau2 = mysql_real_escape_string($_POST['pass']);
            $amount = $_POST['amount'];
            $type = $_POST['type'];
            $magd = $_POST['magd'];
            $tongtiennhan = $_POST['tongtiennhan'];
            $tonghoahong = $_POST['tonghoahong'];
            $inputPass2 = md5($matkhau2);
            $getPass2 = kiemtramk2($id);
            $test = $inputPass2 ."-". $getPass2['nguoidung_matkhaugd'];
            if($getPass2['nguoidung_matkhaugd'] == $inputPass2){
                if($type == "rwallet"){
                    if($tongtiennhan  >= $amount){
                        $tongtiennhan -= $amount;
                        $isRuttien = ruttien($id, $tongtiennhan, $tonghoahong);
                    }
                    else {
                        $isRuttien = false;
                    }
                }
                else {
                    if($tonghoahong >= $amount){
                        $tonghoahong -= $amount;
                        $isRuttien = ruttien($id, $tongtiennhan, $tonghoahong);
                    }
                    else {
                        $isRuttien = false;
                    }
                }
                
                if($isRuttien){
                    $isTaolenh = taolenhgd($id, $magd, $amount);
                }
                else {
                    $isTaolenh = false;
                }
                
                if($isRuttien && $isTaolenh){
                    echo 1;
                }
                else {
                    if(!$isRuttien){
                        echo 3;
                    }
                    else {
                        echo 0;
                    }
                }
            }
            else{
                echo 2;
            }
        }
        else if($action == 'createGDFromCoupon'){
            $id = $_POST['userid'];
            $matkhau2 = mysql_real_escape_string($_POST['pass']);
            $inputPass2 = md5($matkhau2);
            $getPass2 = kiemtramk2($id);
            $amount = $_POST['amount'];
            $magd = $_POST['magd'];
            if($getPass2['nguoidung_matkhaugd'] == $inputPass2){
                $isTaolenh = createGDCoupon($id, $magd, $amount);
                $idUpdate = updateGetCoupon($id);
                if($isTaolenh && $idUpdate){
                    echo 1;
                }
                else {
                        echo 0;
                }
            }
            else {
                echo 2;
            }
        }
        else if($action == 'rwallet'){
            echo '<option>150</option>';
        }
        else if($action == 'cwallet'){
            $userID = $_POST['userID'];
            $listF1 = getListF1($userID);
            $countF1 = mysql_num_rows($listF1);
            $output = "";
            $maxAmount = 0;
            if($countF1 >= 30){
                $maxAmount = 350;
            }
            else if($countF1 >= 20){
                $maxAmount = 200;
            }
            else if($countF1 >= 10){
                $maxAmount = 100;
            }
            else if ($countF1 >= 5){
                $maxAmount = 50;
            }
            for($i = 50; $i <= $maxAmount; $i+=50 ){
                $output .= '<option>'.$i.'</option>';
            }
            
            echo $output;
        }
    }
?>