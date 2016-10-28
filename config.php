<?php
    // A simple PHP script demonstrating how to connect to MySQL.
    // Press the 'Run' button on the top to start the web server,
    // then click the URL that is emitted to the Output tab of the console.

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "btcclub";
    $dbport = 3306;

    // Create connection
    //$db = new mysqli($servername, $username, $password, $database, $dbport);
    $connect = mysql_pconnect($servername, $username, $password) or die('Not connected DB!');
    $db = mysql_select_db($database, $connect) or die('Not selected DB!');
    mysql_query('SET NAMES UTF8', $connect);

    // Check connection
    // if ($db->connect_error) {
    //     die("Connection failed: " . $db->connect_error);
    // } 
    // echo "Connected successfully (".$db->host_info.")";
?>