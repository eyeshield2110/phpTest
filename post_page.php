<?php
/*
$mysqli = new mysqli("192.168.0.106", "uec353_4", "c0NcR6iA", "test");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
} else {
    echo "<script>console.log('Connected the post page to db!')</script>" . "<br>";
}
*/
?>

<?php
if (isset($_POST)) {
    echo "new medicare: " . $_POST['medicare'] . "\n";
}
// try to post to database

?>

<?php
$servername = "192.168.0.106";
$username = "uec353_4";
$password = "c0NcR6iA";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = sprintf("INSERT INTO demo (medicare)
VALUES ('%s')", $_POST['medicare']);

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<h1>New person added!</h1>
<a href="CRUD.php">Do not refresh the page and click here to go back </a>
