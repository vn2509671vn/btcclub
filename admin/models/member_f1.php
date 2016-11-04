<?php 
    require("../../config.php");
    function getid($username){
        $query = "select nd.nguoidung_id from nguoidung nd where nd.nguoidung_taikhoan = '$username'";
        return mysql_query($query);
    }
    function danhsach_user($id){
        $query = "select * from nguoidung nd  where nd.nguoidung_gioithieu = " . $id;   
        return mysql_query($query);
    }
    function danhsach(){
        $query = "SELECT nguoidung_id, nguoidung_taikhoan, nguoidung_matkhaudn, nguoidung_matkhaugd, nguoidung_hoten, nguoidung_sdt, nguoidung_mail, nguoidung_diachi, nguoidung_btclink, nguoidung_gioithieu, nguoidung_parent_id, nguoidung_trangthaikichhoat, nguoidung_hankichpd1, nguoidung_dakichpd1, nguoidung_trangthaihoatdong, nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan, nguoidung_capbac, nguoidung_sopin, nguoidung_sopindadung, nguoidung_sotiennhan, nguoidung_sotienhoahong, nguoidung_soluongtaikhoan FROM nguoidung where nguoidung_taikhoan not like 'admin'";   
        return mysql_query($query);
    }
    // F1 la nguoi gioi thieu truc tiep
    function danhsach_f1($id){ 
        $query = "SELECT nguoidung_id, nguoidung_taikhoan, nguoidung_matkhaudn, nguoidung_matkhaugd, nguoidung_hoten, nguoidung_sdt, nguoidung_mail, nguoidung_diachi, nguoidung_btclink, nguoidung_gioithieu, nguoidung_parent_id, nguoidung_trangthaikichhoat, nguoidung_hankichpd1, nguoidung_dakichpd1, nguoidung_trangthaihoatdong, nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan, nguoidung_capbac, nguoidung_sopin, nguoidung_sopindadung, nguoidung_sotiennhan, nguoidung_sotienhoahong, nguoidung_soluongtaikhoan FROM nguoidung where nguoidung_gioithieu = $id";   
        return mysql_query($query);
    }
    function getnhanh($id){
        $checkchild = "select * from nguoidung where nguoidung_parent_id = " . $id;  
        $countchild = mysql_query($checkchild);
        // $count = mysql_num_rows($countchild);
        // if ($count<2) {
        //     $query = "select * from nguoidung where nguoidung_id = $id or nguoidung_parent_id=$id";   
        // }
        // else{
        //     $query = "select * from nguoidung where nguoidung_parent_id=" . $id;
        // }
        return mysql_query($query);
    }
    function sttaccount($id){
        $query = "SELECT nguoidung_id, nguoidung_taikhoan, nguoidung_matkhaudn, nguoidung_matkhaugd, nguoidung_hoten, nguoidung_sdt, nguoidung_mail, nguoidung_diachi, nguoidung_btclink, nguoidung_gioithieu, nguoidung_parent_id, nguoidung_loainhanh, nguoidung_giatricanbang, nguoidung_phantramhoahong, nguoidung_trangthaikichhoat, nguoidung_hankichpd1, nguoidung_dakichpd1, nguoidung_trangthaihoatdong, nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan, nguoidung_capbac, nguoidung_sopin, nguoidung_sopindadung, nguoidung_sotiennhan, nguoidung_sotienhoahong, nguoidung_hethong from nguoidung nd where nd.nguoidung_id=" . $id;
        return mysql_fetch_array(mysql_query($query));
    }
    function thanhvien_pd($ds_thanhvien){
        $query= "select * from pd 
            left join transfer_pd_gd giaodich on pd.pd_id = giaodich.transfer_mapd_id
            left join nguoidung nd on pd.pd_nguoidung_id = nd.nguoidung_id
            where pd.pd_nguoidung_id IN ($ds_thanhvien) and transfer_time_remain > now() and transfer_pd_status not like 'transfered'";
            return mysql_query($query);
    }
    function thanhvien_gd($ds_thanhvien){
        $query= "select * from pd 
            left join transfer_pd_gd giaodich on pd.pd_id = giaodich.transfer_mapd_id
            left join nguoidung nd on pd.gd_nguoidung_id = nd.nguoidung_id
            where pd.gd_nguoidung_id IN ($ds_thanhvien) and transfer_time_remain > now() and transfer_gd_status not like 'transfered'";
            return mysql_query($query);
    }
    function get_pd_report(){
        $query= "select nd.nguoidung_taikhoan, nd.nguoidung_hoten, nd.nguoidung_sdt, nd.nguoidung_btclink, nguoidung_trangthaihoatdong, giaodich.transfer_ngaytao,transfer_time_remain,transfer_magd,transfer_pd_status,  nguoidung_id,  nguoidung_gioithieu, nguoidung_parent_id, nguoidung_loainhanh
        , nguoidung_giatricanbang, nguoidung_phantramhoahong, nguoidung_trangthaikichhoat, nguoidung_hankichpd1, nguoidung_dakichpd1, nguoidung_trangthaihoatdong
        , nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan, nguoidung_capbac, nguoidung_sopin, nguoidung_sopindadung, 
        , nguoidung_sotienhoahong, nguoidung_hethong from pd 
            left join transfer_pd_gd giaodich on pd.pd_id = giaodich.transfer_mapd_id
            left join nguoidung nd on pd.pd_nguoidung_id = nd.nguoidung_id
            where transfer_gd_status like 'report'";
        return mysql_query($query);
    }
    function get_gd_report(){
        $query= "select nd.nguoidung_taikhoan, nd.nguoidung_hoten, nd.nguoidung_sdt, nd.nguoidung_btclink, nguoidung_trangthaihoatdong, giaodich.transfer_ngaytao,transfer_time_remain,transfer_magd,transfer_gd_status,  nguoidung_id,  nguoidung_gioithieu, nguoidung_parent_id, nguoidung_loainhanh, nguoidung_giatricanbang, nguoidung_phantramhoahong, nguoidung_trangthaikichhoat, nguoidung_hankichpd1, nguoidung_dakichpd1, nguoidung_trangthaihoatdong, nguoidung_quyen, nguoidung_ngaytao, nguoidung_soluongtaikhoan, nguoidung_capbac, nguoidung_sopin, nguoidung_sopindadung, nguoidung_sotiennhan, nguoidung_sotienhoahong, nguoidung_hethong from gd 
            left join transfer_pd_gd giaodich on gd.gd_id = giaodich.transfer_magd_id
            left join nguoidung nd on gd.gd_nguoidung_id = nd.nguoidung_id
            where transfer_pd_status like 'report'";
        return mysql_query($query);
    }
    function count_id(){
        $query="select count(nguoidung_id) from nguoidung";
        return mysql_query($query);
    }
    function getlichsupin($id){
        $query = "SELECT pin_id, pin_nguoidung_id, pin_transaction_type, pin_giatri, pin_system_description, pin_user_description, pin_ngaytao FROM pin  where pin_nguoidung_id=" . $id;
        return mysql_query($query);
    }
    function getparent($id){
        $query = "select nguoidung_id from nguoidung where nguoidung_parent_id=$id";
        return mysql_query($query);
    }
    function pathparent($source, $parent, &$newString){
        if( mysql_num_rows(getparent($parent)) != 3){
    	        $newString .= $parent . ',';
    	    }
    	if(count($source) > 0) {
    		foreach ($source as $key => $value){
    		    if( mysql_num_rows(getparent($source[$key]['nguoidung_id'])) != 3){
        			if($value['nguoidung_parent_id'] == $parent){
        				$newString .= $value['nguoidung_id'] . ',';
        				unset($source[$key]);
        				$newParent = $value['nguoidung_id'];
        				pathparent($source, $newParent, $newString);
        			}
    		    }
    		}
    	}
    	return $newString;
    }   
    function nhanhcon($source, $parent, &$newString){
    	if(count($source) > 0) {
    		foreach ($source as $key => $value){
        			if($value['nguoidung_parent_id'] == $parent){
        				$newString .= $value['nguoidung_id'] . ',';
        				unset($source[$key]);
        				$newParent = $value['nguoidung_id'];
        				nhanhcon($source, $newParent, $newString);
    		    }
    		}
    	}
    	return $newString;
    }   
    function recursive($source, $parent, &$newString){
    	if(count($source) > 0) {
    	    $newString .= '<ul>';
    		foreach ($source as $key => $value){
    		    if( mysql_num_rows(getparent($source[$key]['nguoidung_id'])) != 3){
        			if($value['nguoidung_parent_id'] == $parent){
        				$newString .= '<li>';
        				$newString .= $value['nguoidung_id'];
        				unset($source[$key]);
        				$newParent = $value['nguoidung_id'];
        				recursive($source, $newParent, $newString);
        				$newString .= '</li>';
        			}
    		    }
    		}
    		$newString .= '</ul>';
    	}
    	return $newString;
    }   
?>