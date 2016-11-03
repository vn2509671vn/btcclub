<?php
    function userDetail($userID){
        $query = "select * from nguoidung where nguoidung_id = $userID";
        return mysql_fetch_array(mysql_query($query));
    }
    function userPDDetail($idpd){
        $query = "select pd_id, nd.nguoidung_id, nd.nguoidung_hoten, nd.nguoidung_taikhoan, nd.nguoidung_sdt,nd.nguoidung_mail, nd.nguoidung_gioithieu, nguoidung_btclink from pd left join nguoidung nd on pd.pd_nguoidung_id = nd.nguoidung_id
                where pd.pd_id=$idpd";
        return mysql_fetch_array(mysql_query($query));
    }
    function getF1($userID){
        $query = "select * from nguoidung where nguoidung_gioithieu = $userID";
        return mysql_query($query);
    }
?>