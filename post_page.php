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

$insert_table = $_POST['table'];
$sql = '';
switch($insert_table) {
    case 'person':
        $sql = sprintf("INSERT INTO person 
    (medicare, dob, first_name, last_name, telephone, email, address, postal_code, citizenship)
    VALUES ('%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s')",
        $_POST['medicare'], $_POST['dob'], $_POST['first_name'], $_POST['last_name'],
        $_POST['telephone'], $_POST['email'], $_POST['address'], $_POST['postal_code'],
        $_POST['citizenship']);
        break;
    case 'healthWorker': // Review the healthWorker schema... add a facilityID + workerFacilityID?
        $sql = sprintf("INSERT INTO healthWorker () VALUES ()");
        break;
    case 'healthCenter':
        $sql = sprintf("INSERT INTO healthCenter () VALUES ()");
        break;
    case 'groupzone':
        $sql = sprintf("INSERT INTO groupzone () VALUES ()");
        break;
    case 'region':
        $sql = sprintf("INSERT INTO region (name, province) VALUES ('%s', '%s')",
        $_POST['region'], $_POST['province']);
        break;
    case 'postalCode':
        $sql = sprintf("INSERT INTO postalCode (code, cityName) VALUES ('%s', '%s')",
        $_POST['postal_code'], $_POST['city']);
        break;
    case 'city':
        $sql = sprintf("INSERT INTO city (name, regionName) VALUES ('%s', '%s')",
        $_POST['city'], $_POST['region']);
        break;
    default:
        echo "no valid table selected (hidden form input not configured, etc.)";
        break;
}


// $sql = sprintf("INSERT INTO demo (medicare) VALUES ('%s')", $_POST['medicare']);

if ($conn->query($sql) === TRUE) {
    echo "<h4>New record created successfully</h4>";
    echo "<a href='search_person.php'>Do not refresh the page and click here to go back </a>";

} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Display the form data

if (isset($_POST)) {
    foreach ($_POST as $key => $value) {
        echo "<div>" . $key . ": " . $value . "</div>";

    }
}


$conn->close();
?>



