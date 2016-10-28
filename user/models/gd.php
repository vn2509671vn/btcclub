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
    
    function kiemtramk2($id){
        $query = "select * from nguoidung where nguoidung_id=$id";
        $result = mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    if(isset($_POST['action'])){
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
                $tongtiennhan -= $amount;
                $isRuttien = ruttien($id, $tongtiennhan, $tonghoahong);
            }
            else {
                $tonghoahong -= $amount;
                $isRuttien = ruttien($id, $tongtiennhan, $tonghoahong);
            }
            $isTaolenh = taolenhgd($id, $magd, $amount);
            if($isRuttien && $isTaolenh){
                echo 1;
            }
            else {
                echo 0;
            }
        }
        else{
            echo 2;
        }
    }
?>