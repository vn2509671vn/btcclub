<?php
    function userDetail($userID){
        $query = "select * from nguoidung where nguoidung_id = $userID";
        return mysql_fetch_array(mysql_query($query));
    }
    
    function getF1($userID){
        $query = "select * from nguoidung where nguoidung_gioithieu = $userID";
        return mysql_query($query);
    }
?>