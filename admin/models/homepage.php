<?php 
    require("../../config.php");
    function getInfoUser($userID){
        $query = "select * from nguoidung where nguoidung_id = $userID";
        return mysql_fetch_array(mysql_query($query));
    }
?>