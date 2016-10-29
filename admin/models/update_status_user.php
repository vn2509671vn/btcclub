<?php 
    require("../../config.php");
    function updateFreeze($id,$status){
        //$query = "update nguoidung set nguoidung_trangthaihoatdong='$status', nguoidung_sopin = 0 where nguoidung_id=$id";
        $query = "update nguoidung set nguoidung_trangthaihoatdong='$status', nguoidung_sopin = 0 where nguoidung_id=$id";
        return mysql_query($query);
    }
    if(isset($_POST['action'])){
        $id = $_POST['id'];
        $status = $_POST['action'];
        if($status == 'freeze')
        {
            $isUpdatefreeze = updateFreeze($id,$status);
            if($isUpdatefreeze){
                echo 1;
            }
            else{
                echo 2;
            }
        }
        else if($status == 'normal')
        {
            $isUpdateclock = updateFreeze($id,$status);
            if($isUpdateclock){
                echo 1;
            }
            else{
                echo 2;
            }
        }
        else if($status == 'clock')
        {
            $isUpdateclock = updateFreeze($id,$status);
            if($isUpdateclock){
                echo 1;
            }
            else{
                echo 2;
            }
        }
    }
?>