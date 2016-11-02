<?php 
    // function getTotalValue($parentID=null, $gTotal=0){
    //     // Create the query
    //     $query = "SELECT * FROM nguoidung WHERE ";
    //     if($parentID == null) {
    //         $query .= "nguoidung_parent_id IS NULL";
    //     }
    //     else {
    //         $query .= "nguoidung_parent_id=" . intval($parentID);
    //     }
    //     // Execute the query and go through the results.
    //     $result = mysql_query($query);
    //     if($result)
    //     {
    //         while($row = mysql_fetch_array($result))
    //         {
    //             //The current ID;
    //             $currentID = $row['nguoidung_id'];
    //             // Sum all children of the current ID
    //             if($row['nguoidung_sopindadung'] >= 1){
    //                 $gTotal += 100;
    //             }
    //             $gTotal = getTotalValue($currentID, $gTotal);
    //         }
    //     }
    //     return $gTotal;
    // }
    
    // function getParent($userID, $arrParent){
    //     $arrTmp = array();
    //     $arrTmp = $arrParent;
    //     // Create the query
    //     $query = "SELECT * FROM nguoidung WHERE nguoidung_id = $userID";
    //     // Execute the query and go through the results.
    //     $result = mysql_query($query);
    //     if($result)
    //     {
    //         while($row = mysql_fetch_array($result))
    //         {
    //             // The current ID;
    //             $currentID = $row['nguoidung_parent_id'];
    //             // Count all parent of the current ID
    //             if($currentID != NULL){
    //                 array_push($arrTmp, $currentID);
    //             }
    //             $arrTmp = getParent($currentID, $arrTmp);
    //         }
    //     }
    //     return $arrTmp;
    // }
    
    // function getLeftNode($parentID){
    //     $query = "select * from nguoidung where nguoidung_parent_id = $parentID and nguoidung_loainhanh = 'L'";
    //     $result = mysql_query($query);
    //     return mysql_fetch_array($result);
    // }
    
    // function getRightNode($parentID){
    //     $query = "select * from nguoidung where nguoidung_parent_id = $parentID and nguoidung_loainhanh = 'R'";
    //     $result = mysql_query($query);
    //     return mysql_fetch_array($result);
    // }
    
    function getCommissionList($nguoidung_id){
        $query = "select * from commission where commission_nguoidung_id = $nguoidung_id";
        return mysql_query($query);
    }
?>