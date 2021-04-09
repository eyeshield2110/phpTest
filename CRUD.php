<?php
/*
$mysqli = new mysqli("uec353.encs.concordia.ca", "uec353_4", "c0NcR6iA", "uec353_4");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
} else {
    echo "Successful connection to db!" . "<br>";
}

// Testing queries
// #1: Person DISPLAY

$name = "Noah";

$query = sprintf("SELECT id, name FROM demo WHERE name='%s'", $name);
$result = $mysqli->query($query);

// Check result
if ($result->num_rows > 0) {
// function num_rows() checks number of rows in result
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Name " . $row["name"] . "<br>";
    }
} else {
    echo "Zero results";
}
$mysqli->close();


*/
?>


<form id="search-form" action="#" method="get">
    <input type="text" id="search-input" name="searchInput" placeholder="Search by..." required>
    <select name="searchType" id="search-type" onchange="changeInput()">
        <option value="first_name">First name</option>
        <option value="last_name">Last name</option>
        <option value="dob">Date of birth</option>
        <option value="telephone">Telephone</option>
        <option value="email">Email</option>
        <option value="postal_code">Postal code</option>
        <option value="*">All</option>
    </select>
    <div>
        <input type="submit">
    </div>


</form>
<script>
    const changeInput = () => {
        let search_type = document.getElementById('search-type')
        let input = document.getElementById('search-input')
        switch (search_type.value) {
            case 'first_name':
                input.placeholder = 'Search by first name'
                input.type = 'text'
                break;
            case 'last_name':
                input.placeholder = 'Search by last name'
                input.type = 'text'
                break;
            case 'dob':
                input.placeholder = 'Search by date of birth'
                input.setAttribute('type', 'date')
                break;
            case 'telephone':
                input.placeholder = 'Search by telephone'
                input.type = 'tel'
                break;
            case 'email':
                input.placeholder = 'Search by email'
                input.type = 'email'
                break;
            case 'postal_code':
                input.placeholder = 'Search postal code'
                input.type = 'text'
                break;
            default:
                input.placeholder = 'Show all'
                input.type = 'text'
        }
    }

</script>


