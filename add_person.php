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

<?php
// fetch the postal codes
$codes_query = 'SELECT code FROM postalCode';
$codes_result = $mysqli->query($codes_query);
$postal_codes = [];
while ($row = $codes_result->fetch_assoc()) {
    $postal_codes[] = $row;
}
// fetch the cities
$cities_query = 'SELECT name FROM city';
$cities_result = $mysqli->query($cities_query);
$cities = [];
while ($row = $cities_result->fetch_assoc()) {
    $cities[] = $row;
}

// check for errors
if ($mysqli->errno)
    echo "Error in query/ies. ";
?>
<h3>Add a person</h3>
<!-- person form - if postal is not in db yet, add it -->
<!-- how to handle error: if entering the wrong city for a postal code that exist for a different city? -->
<form action="post_page.php" method="post">
    <div>
        <input type="text" name="medicare" id="medicare" placeholder="Enter medicare number" required>
    </div>
    <div>
        <input type="date" name="dob" id="dob" required>
    </div>
    <div>
        <input type="text" name="first_name" id="first_name" placeholder="First name" required>
    </div>
    <div>
        <input type="text" name="last_name" id="last_name" placeholder="Last name" required>
    </div>
    <div>
        <label for="telephone">For a number (123) 456-7890, format as 1234567890</label>
    </div>
    <div>
        <input type="tel" name="telephone" id="telephone" placeholder="Phone number" required>
    </div>
    <div>
        <input type="email" name="email" id="email" placeholder="Enter email">
    </div>
    <div>
        <input type="text" name="address" id="address" placeholder="Address" required>
    </div>
    <div id="postal_code_div">
        <select name="postal_code" id="postal_code_select" required>
            <option value="" disabled selected>Select zip code/Postal code</option>
            <!-- Fetch codes from database -->
            <?php
            foreach ($postal_codes as $row) {
                foreach ($row as $key => $postal_code) {
                    echo '<option value="' . $postal_code . '">' . $postal_code . '</option>';
                }
            }
            ?>
        </select>
    </div>

    <div>
        <select name="citizenship" id="citizenship">
            <option value="" selected disabled>Select citizenship</option>
            <option value="canadian">Canadian</option>
        </select>
    </div>
    <input type="hidden" name="table" value="person">
    <div>
        <input type="submit">
    </div>

</form>

<?php
include 'links_partials.php';
?>
