<?php   
require('../models/messages.php');
    $contain = $_POST['contain'];
    $subject = $_POST['subject'];
    $toUser = $_POST['receiver'];
    $fromID = $_POST['fromUserID'];
    $image = basename($_FILES["fileToUpload"]["name"]);
    $output = false;
    if($image == ""){
        $image_name = "";
    }
    else {
        $target_dir = "../../img/msg/";
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $image_name = basename( $_FILES["fileToUpload"]["name"]);
    }
    
    $userReceived = getUserByTK($toUser);
    if(mysql_num_rows($userReceived) <= 0){
        $output = '<script type="text/javascript">alert("NGƯỜI NHẬN KHÔNG TỒN TẠI!!!");</script>';
    }
    else {
        $userDetail = mysql_fetch_array($userReceived);
    }
            
    if(!$output){
        $receiverID = $userDetail['nguoidung_id'];
        if($receiverID){
            $result = composeNew($fromID, $receiverID, $subject, $contain, $image_name);
        }
                
        if($result){
            $output =  '<script type="text/javascript">alert("GỬI MAIL THÀNH CÔNG!!!");window.location.replace("../views/sent.php");</script>';
        }
        else {
            $output =  '<script type="text/javascript">alert("GỬI MAIL THẤT BẠI!!!");</script>';
        }
    }
    echo $output;
 ?>  