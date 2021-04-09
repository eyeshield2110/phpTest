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

<?php

$mysqli = new mysqli("uec353.encs.concordia.ca", "uec353_4", "c0NcR6iA", "uec353_4");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
} else {
    echo "Successful connection to db!" . "<br>";
}

?>

<form id="search-form" action="CRUD.php" method="get">
    <input type="text" id="search-input" name="searchInput" placeholder="Search by..." disabled required>
    <select name="searchType" id="search-type" onchange="changeInput()">
        <option value="" selected disabled>Select a search option</option>
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

<div id="display-request-params">
    <label for="request-list">Search parameters</label>
    <ul id="request-list">
        <?php
        $where_input = $_GET['searchInput'];
        $select_input = $_GET['searchType'];

        if (count($_GET) > 0) {
            echo "<li>WHERE = " . $where_input . "</li>";
            echo "<li>SELECT = " . $select_input . "</li>";
        }
        ?>
    </ul>
</div>
<div id="display-query-result">
    <?php
    echo "\n";
    if (count($_GET) > 0) {
        if ($select_input == "*") {
            $query = 'SELECT * FROM person';
            $result = $mysqli->query($query);
        } else {
            $query = sprintf('SELECT * FROM person WHERE %s="%s"', $select_input, $where_input);
            $result = $mysqli->query($query);
        }
        echo "Results: ";
        echo "<ol>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            foreach ($row as $key => $value) {
                echo "$key: $value\t";
            }
            echo "</li>";
        }
        echo "</ol>";
    }
    ?>
</div>
<div>
    <table style="border:1px">
        <caption>Result of query (Table)</caption>
        <?php

        if (count($_GET) > 0) {
            if ($select_input == "*") {
                $query = 'SELECT * FROM person';
                $result = $mysqli->query($query);
            } else {
                $query = sprintf('SELECT * FROM person WHERE %s="%s"', $select_input, $where_input);
                $result = $mysqli->query($query);
            }
            echo "<thead><tr>";
            foreach ($result[0] as $key => $value) {
                echo "<th>";
                echo "$key";
                echo "</th>";
            }
            echo "</tr></thead>";

            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "$key: $value\t";
                }
                echo "</tr>";
            }
            echo "</tbody>";
        }

        ?>
    </table>
</div>


<script>
    const changeInput = () => {
        let search_type = document.getElementById('search-type')
        let input = document.getElementById('search-input')
        switch (search_type.value) {
            case 'first_name':
                input.disabled = false
                input.placeholder = 'Search by first name'
                input.type = 'text'
                break;
            case 'last_name':
                input.disabled = false
                input.placeholder = 'Search by last name'
                input.type = 'text'
                break;
            case 'dob':
                input.disabled = false
                input.placeholder = 'Search by date of birth'
                input.setAttribute('type', 'date')
                break;
            case 'telephone':
                input.disabled = false
                input.placeholder = 'Search by telephone'
                input.type = 'tel'
                break;
            case 'email':
                input.disabled = false
                input.placeholder = 'Search by email'
                input.type = 'email'
                break;
            case 'postal_code':
                input.disabled = false
                input.placeholder = 'Search postal code'
                input.type = 'text'
                break;
            default:
                input.disabled = true
                input.placeholder = 'Show all'
                input.type = 'text'
        }
    }

</script>

<?php
$mysqli->close();
?>

