<?php
$servername = "192.168.0.106";
$username = "uec353_4";
$password = "c0NcR6iA";
$dbname = "test";

$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
} else {
    echo "<script>console.log('connected to mysql')</script>";
}

