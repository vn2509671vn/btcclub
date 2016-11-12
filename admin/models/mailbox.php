<?php 
    require('../../config.php');
    function getCountInbox($userID){
        $query = "select * from messages where receiver = $userID and isread = 0";
        return mysql_query($query);
    }
?>