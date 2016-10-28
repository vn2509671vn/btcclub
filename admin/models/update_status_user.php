<?php 
    require("../../config.php");
    function updateFreeze($id,$status){
        $query = "update nguoidung set nguoidung_trangthaihoatdong='$status' where nguoidung_id=$id";
        return mysql_query($query);
    }
    function updateClock($id,$status){
        $query = "update nguoidung set nguoidung_trangthaihoatdong='$status' where nguoidung_id=$id";
        return mysql_query($query);
    }
    if(isset($_POST['action'])){
        $id = $_POST['id'];
        $status = $_POST['action'];
        if($status == 'freeze')
        {
            $isUpdatefreeze = updateFreeze($id);
            if($isUpdatefreeze){
                echo 1;
            }
        }
        else if($status == 'normal')
        {
            $isUpdateclock = updateFreeze($id,$status);
            if($isUpdateclock){
                echo 2;
            }
        }
    }
?>