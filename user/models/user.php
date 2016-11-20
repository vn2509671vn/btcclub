<?php
    require("../../config.php");

    function userDetail($userID){
        $query = "select * from nguoidung where nguoidung_id = $userID";
        return mysql_fetch_array(mysql_query($query));
    }
    function dspd($nguoidung_id){
        $query = "select pd.pd_id, pd.pd_mapd, pd.pd_ngaytao, pd.pd_filled, pd.pd_maxprofit, pd.pd_status, nguoidung.nguoidung_taikhoan as 'taikhoan' from pd, nguoidung where pd.pd_nguoidung_id = nguoidung.nguoidung_id and pd.pd_nguoidung_id = $nguoidung_id and pd.pd_status = 'waiting'";
        return mysql_query($query);
    }
    function dsgd($nguoidung_id){
        $query = "select gd.gd_id, gd.gd_magd, gd.gd_ngaytao, gd.gd_giatri, gd.gd_status, nguoidung.nguoidung_taikhoan as 'taikhoan' from gd, nguoidung where gd.gd_nguoidung_id = nguoidung.nguoidung_id and gd.gd_nguoidung_id = $nguoidung_id and gd.gd_status = 'waiting'";
        return mysql_query($query);
    }
    function getCountInbox($userID){
        $query = "select * from messages where receiver = $userID and isread = 0";
        return mysql_query($query);
    }
    
    function userPDDetail($idpd){
        $query = "select pd_id, nd.nguoidung_id, nd.nguoidung_hoten, nd.nguoidung_taikhoan, nd.nguoidung_sdt,nd.nguoidung_mail, nd.nguoidung_gioithieu, nguoidung_btclink from pd left join nguoidung nd on pd.pd_nguoidung_id = nd.nguoidung_id
                where pd.pd_id=$idpd";
        return mysql_fetch_array(mysql_query($query));
    }
    
    function getF1($userID){
        $query = "select * from nguoidung where nguoidung_gioithieu = $userID and nguoidung_sopindadung > 0";
        return mysql_query($query);
    }
    
    function getChild($userID, $arrChild){
        $arrTmp = array();
        $arrTmp = $arrChild;
        // Create the query
        $query = "SELECT * FROM nguoidung WHERE ";
        if($userID == null) {
            $query .= "nguoidung_parent_id IS NULL";
        }
        else {
            $query .= "nguoidung_parent_id=" . intval($userID);
        }
        // Execute the query and go through the results.
        $result = mysql_query($query);
        if($result)
        {
            while($row = mysql_fetch_array($result))
            {
                // The current ID;
                $currentID = $row['nguoidung_id'];
                // Count all parent of the current ID
                array_push($arrTmp, $row);
                $arrTmp = getChild($currentID, $arrTmp);
            }
        }
        return $arrTmp;
    }
?>