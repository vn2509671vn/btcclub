<?php 
    require("../../config.php");
    
    function getUserByTK($account){
        $query = "select * from nguoidung where nguoidung_taikhoan = '$account'";
        return mysql_query($query);
    }
    
    function getAllUser(){
        $query = "select * from nguoidung";
        return mysql_query($query);
    }
    
    function getInbox($userID){
        $query = "select messages.*, nguoidung.* from messages, nguoidung where messages.receiver = $userID and messages.sender = nguoidung.nguoidung_id ORDER BY messages.create_date DESC";
        return mysql_query($query);
    }
    
    function getSent($userID){
        $query = "select messages.*, nguoidung.* from messages, nguoidung where messages.sender = $userID and messages.receiver = nguoidung.nguoidung_id ORDER BY messages.create_date DESC";
        return mysql_query($query);
    }
    
    function composeNew($sender, $receiver, $subject, $contain, $path){
        date_default_timezone_set('Asia/Bangkok');
        $datetime = new DateTime();
        $curDate = $datetime->format('Y-m-d H:i:s');
        $query = "insert into messages(receiver, sender, subject, contain, path_img, create_date) value ($receiver, $sender, '$subject', '$contain', '$path', '$curDate')";
        return mysql_query($query);
    }
    
    function doRead($msgID){
        $query = "update messages set isread = 1 where messages_id = $msgID";
        return mysql_query($query);
    }
    
    function msgIBDetail($msgID){
        $query = "select messages.*, nguoidung.* from messages, nguoidung where messages.messages_id = $msgID and messages.sender = nguoidung.nguoidung_id";
        $result =  mysql_query($query);
        return mysql_fetch_array($result);
    }
    
    function msgSentDetail($msgID){
        $query = "select messages.*, nguoidung.* from messages, nguoidung where messages.messages_id = $msgID and messages.receiver = nguoidung.nguoidung_id";
        $result =  mysql_query($query);
        return mysql_fetch_array($result);
    }
?>