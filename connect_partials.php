<?php
$servername = "192.168.0.106";
$username = "uec353_4";
$password = "c0NcR6iA";
$dbname = "test";

$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to local MySQL: " . $mysqli->connect_error;
    // exit();
    $db_host = 'uec353.encs.concordia.ca';
    $db_user = 'uec353_4';
    $db_password = 'c0NcR6iA';
    $db_db = 'uec353_4';
    $db_port = 3306;
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        echo "Failed to connect to AITS server mysql";
    } else {
        echo "connected to AITS server mysql";
    }
} else {
    echo "<script>console.log('connected to mysql')</script>";
}

