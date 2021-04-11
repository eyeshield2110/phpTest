<?php
$servername = "192.168.0.106";
$username = "uec353_4";
$password = "c0NcR6iA";
$dbname = "test";


$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_errno) {
    // echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    // exit();
    $db_host = 'uec353.encs.concordia.ca';
    $db_user = 'uec353_4';
    $db_password = 'c0NcR6iA';
    $db_db = 'uec353_4';
    $db_port = 3306;
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_db);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to AITS";
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    } else {
        echo "<script>console.log('connected to AITS mysql')</script>";
    }
} else {
    echo "<script>console.log('connected to mysql')</script>";
}

