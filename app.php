<?php
$db_host = 'uec353.encs.concordia.ca';
$db_user = 'uec353_4';
$db_password = 'c0NcR6iA';
$db_db = 'uec353_4';
$db_port = 3306;

$mysqli = new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error;
    exit();
}

echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: '.$mysqli->host_info;
echo '<br>';
echo 'Protocol version: '.$mysqli->protocol_version;

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<body>

<h1>My first PHP page</h1>

<?php
echo "Hello World!";
?>
<br>
<a href="./anothertest.php">Link to "anothertest.php"</a>

</body>
</html>