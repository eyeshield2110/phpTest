<style>
    table, td, th, tr {
        border: solid black 1px;
    }

    div {
        padding: 5px;
        margin: 5px;
    }
</style>

<?php
include 'connect_partials.php'
?>

<h3>Search a person</h3>
<form id="search-form" action="search_person.php" method="get">
    <div>
        <input type="text" id="search-input" name="searchInput" placeholder="Search by..." disabled required>
        <select required name="searchType" id="search-type" onchange="changeInput()">
            <option value="" selected disabled>Select a search option</option>
            <option value="medicare">Medicare</option>
            <option value="first_name">First name</option>
            <option value="last_name">Last name</option>
            <option value="dob">Date of birth</option>
            <option value="telephone">Telephone</option>
            <option value="email">Email</option>
            <option value="postal_code">Postal code</option>
            <option value="*">All</option>
        </select>
    </div>
    <div>
        <input type="submit">
    </div>

</form>

<?php
include 'links_partials.php';
?>

<div id="display-request-params">

    <?php

    $where_input = $_GET['searchInput'];
    $select_input = $_GET['searchType'];

    if (count($_GET) > 0) {
        echo "<h4>Search parameters</h4>
        <ul id='request-list'>";
        echo "<li>Search by = " . $select_input . "</li>";
        echo "<li>Value = " . $where_input . "</li>";

    }
    echo "</ul>";
    ?>

</div>
<div id="display-query-result">
    <?php
    echo "\n";
    $rows_in_result = [];
    if (count($_GET) > 0) {
        if ($select_input == "*") {
            $query = 'SELECT * FROM person';
            $result = $mysqli->query($query);
        } else {
            $query = sprintf('SELECT * FROM person WHERE %s="%s"', $select_input, $where_input);
            $result = $mysqli->query($query);
        }
        if ($result->num_rows > 0) {
            // echo "<h4>Results (list)</h4>";
        } else {
            echo "<h4>No results</h4>";
        }
        //echo "<ol>";
        while ($row = $result->fetch_assoc()) {
            $rows_in_result[] = $row;
            /*
            echo "<li>";
            foreach ($row as $key => $value) {
                echo "$key: $value\t";
            }

            echo sprintf("<button onclick=deletePerson(`%s`)>Delete</button>", $row['medicare']);
            echo "</li>";
            */
        }
        //echo "</ol>";
    }
    ?>
</div>
<div>

    <?php

    if (count($rows_in_result) > 0) {
        echo "<h3>Result of query (Table)</h3><table>";
        echo "<thead><tr>";
        foreach ($rows_in_result[0] as $key => $value) {
            echo "<th>";
            echo "$key";
            echo "</th>";
        }
        echo "<th>Delete</th>";
        echo "<th>Edit</th>";
        echo "</tr></thead>";


        echo "<tbody>";
        foreach ($rows_in_result as $row) {
            echo "<tr>";
            foreach ($row as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
            $deleteBtn = sprintf("<button onclick='deletePerson(`%s`)'>Delete</button>", $row['medicare']);
            echo "<td>"
                . $deleteBtn
                . "</td>";

            $editMedicare = $row['medicare'];
            $editPage = sprintf("location.href='edit_person.php?id=%s';", $editMedicare);

            $editBtn = sprintf("<button onclick=%s>Edit</button>", $editPage);
            echo "<td>"
                . $editBtn
                . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    }
    echo "</table>";
    ?>

</div>


<script>
    const changeInput = () => {
        let search_type = document.getElementById('search-type')
        let input = document.getElementById('search-input')
        switch (search_type.value) {
            case 'medicare':
                input.disabled = false
                input.placeholder = 'Search by medicare'
                input.type = 'text'
                break;
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


    function deletePerson(medicare) {
        let confirmDelete = confirm('Confirm delete ' + medicare + ' ?')
        if (confirmDelete) {
            let deleteForm = document.createElement('form')
            deleteForm.style.display = 'none'
            deleteForm.action = 'search_person.php'
            deleteForm.method = 'post'
            let input = document.createElement('input')
            input.type = 'text'
            input.name = 'medicare'
            input.value = medicare
            deleteForm.appendChild(input)
            document.body.appendChild(deleteForm)
            deleteForm.submit()
        }
    }

</script>

<?php
// Parse the POST request
if (isset($_POST['medicare'])) {
    $medicareDelete = $_POST['medicare'];
    // Handling POST request to delete
    $delete = sprintf('DELETE FROM person WHERE medicare = "%s"', $medicareDelete);
    if ($mysqli->query($delete) === TRUE) {
        echo "<h4>Successfully deleted record " . $medicareDelete . "</h4>";
    } else {
        echo "Error: " . $delete . "<br>" . $mysqli->error;
    }
}


?>


<?php
$mysqli->close();
?>

