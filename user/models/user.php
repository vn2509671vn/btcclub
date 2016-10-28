<?php 
    function thongtinchitiet($id){
        $query = "select * from nguoidung where nguoidung_id = $id";
        return mysql_fetch_array(mysql_query($query));
    }
?>