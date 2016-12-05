<?php 
    require("../../config.php");
    function updateFreeze($id,$status){
        //$query = "update nguoidung set nguoidung_trangthaihoatdong='$status', nguoidung_sopin = 0 where nguoidung_id=$id";
        $query = "update nguoidung set nguoidung_trangthaihoatdong='$status', nguoidung_sopin = 0, nguoidung_sotienhoahong = 0, nguoidung_sotiennhan = 0 where nguoidung_id=$id";
        return mysql_query($query);
    }
    function updateFreeze_gt($id, $sopin, $sotienhoahong, $sotiennhan){
        $query = "update nguoidung set nguoidung_sopin = $sopin, nguoidung_sotienhoahong = $sotienhoahong, nguoidung_sotiennhan = $sotiennhan where nguoidung_id=$id";
        return mysql_query($query);
    }
    function updateGioiThieu($id, $sopin, $sotienhoahong, $sotiennhan){
        $query = "update nguoidung set nguoidung_sopin = $sopin, nguoidung_sotienhoahong = $sotienhoahong, nguoidung_sotiennhan = $sotiennhan where nguoidung_id=$id";
        return mysql_query($query);
    }
    function sttaccount($id){
        $query = "select nguoidung_trangthaihoatdong, nguoidung_id, nguoidung_taikhoan, nguoidung_matkhaudn, nguoidung_matkhaugd,nguoidung_hoten, nguoidung_sdt, 
            nguoidung_mail, nguoidung_diachi, nguoidung_btclink, nguoidung_gioithieu,nguoidung_parent_id, nguoidung_trangthaikichhoat, nguoidung_hankichpd1, 
            nguoidung_dakichpd1, nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan, nguoidung_capbac,
            nguoidung_sopin, nguoidung_sopindadung, nguoidung_sotiennhan, nguoidung_sotienhoahong, nguoidung_hethong from nguoidung nd where nd.nguoidung_id = $id";
        return mysql_fetch_array(mysql_query($query));
    }
    function getSopin($id){
        $query = "select nguoidung_sopin from nguoidung where nguoidung_id=" .$id;
        return mysql_fetch_array(mysql_query($query));
    }
    function taolichsupin($nguoidung_id, $type, $giatri, $sys_des, $user_des){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "INSERT INTO pin(pin_nguoidung_id, pin_transaction_type, pin_giatri, pin_system_description, pin_user_description, pin_ngaytao) VALUES ($nguoidung_id, '$type', '$giatri', '$sys_des', '$user_des','$curDate')";
        return mysql_query($query);
    }
    function updatepin($id,$sopin){
        $query = "update nguoidung set nguoidung_sopin = $sopin where nguoidung_id = $id";
        return mysql_query($query);
    }
    if(isset($_POST['action'])){
        $id = $_POST['id'];
        $status = $_POST['action'];
        $lstuser = sttaccount($id);
        $gioithieu = $lstuser['nguoidung_gioithieu'];
        $lstgioithieu = sttaccount($gioithieu);
        $sotienhoahong_gt = $lstgioithieu['nguoidung_sotienhoahong'];
        $sotienhoahong_gt = $sotienhoahong_gt / 2;
        // $sotiennhan_gt = $lstgioithieu['nguoidung_sotiennhan'];
        // $sotiennhan_gt =$sotiennhan_gt / 2 ;
        $sopin = $lstuser['nguoidung_sopin'];
        $sopin_gt_tru = $lstgioithieu['nguoidung_sopin'] / 2 ;
        if($status == 'freeze'){    
            $isUpdatefreeze = updateFreeze($id,$status);
            $isUpdatefreeze_gt = updateFreeze_gt($gioithieu, $sopin, $sotienhoahong_gt, $sotiennhan_gt);
            // $isUpdatefreeze_gt = updateFreeze_gt($gioithieu, $sopin, $sotienhoahong_gt, $sotiennhan_gt);
            $isLichSuTru = taolichsupin($id, 'PIN PHẠT', 0 - $sopin , 'Clock Account' , 'Clock Account' );
            // $isLichSuTru_gt = taolichsupin($gioithieu, 'PIN PHẠT', 0 - $sopin_gt_tru, 'Phạt do tài khoản ' . '[' . $lstuser['nguoidung_taikhoan'] . ']', '' );
            if($isUpdatefreeze && $isUpdatefreeze_gt){
                echo 1;
            }
            else{
                echo 2;
            }
        }
        else if($status == 'normal')
        {
            $isUpdateclock = updateFreeze($id,$status);
            $isCongpin = updatepin($id,10);
            $nguoinhan_description = 'Recieved PIN From Admin';
            $noidung=  "Admin chuyển 10 PIN";
            $isLichSuNhan = taolichsupin($id, 'PIN Transfer', 10, $nguoinhan_description, $noidung );
            $isTrupin = updatepin($id,5);
            $nguoiTru_description = 'Used PIN For Open Account';
            $noidung=  "Trừ 5 PIN ( PIN Mở Tài Khoản)";
            $isLichSuTru = taolichsupin($id, 'PIN PHẠT', -5, $nguoiTru_description, $noidung );
            if($isUpdateclock){
                echo 1;
            }
            else{
                echo 2;
            }
        }
        else if($status == 'lock')
        {
            $isUpdateclock = updateFreeze($id,$status);
            $isUpdatefreeze_gt = updateFreeze_gt($gioithieu, $sopin, $sotienhoahong_gt, $sotiennhan_gt);
            $isLichSuTru = taolichsupin($id, 'PIN PHẠT', 0 - $sopin , 'Clock Account' , 'Clock Account' );
            // $isLichSuTru_gt = taolichsupin($gioithieu, 'PIN PHẠT', 0 - $sopin_gt_tru, 'Phạt do tài khoản ' . '[' . $lstuser['nguoidung_taikhoan'] . ']', '' );
            if($isUpdateclock && $isUpdatefreeze_gt){
                echo 1;
            }
            else{
                echo 2;
            }
        }
    }
?>