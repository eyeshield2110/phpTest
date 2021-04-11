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
// CHECK the parameters of the GET request
if (count($_GET) > 0) {
    foreach ($_GET as $item) {
        // echo $item;
    }
}
// Fetch data of person to edit (note: cannot edit the medicare/primary key)
$query = sprintf('SELECT * FROM person WHERE medicare = "%s";', $_GET['id']);
$result = $mysqli->query($query);
$rows_in_result = [];
while ($row = $result->fetch_assoc()) {
    $rows_in_result[] = $row;
}
$person = $rows_in_result[0];
// Ex. how to access person attributes: $person['first_name']

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

<h3>Edit a person</h3>
<form action="post_edit.php" method="post">
    <div>
        <?php
        echo '<input disabled type="text" value="' . $_GET['id'] . '"  required>';
        echo '<input type="hidden" name="medicare" id="medicare" value="' . $_GET['id'] . '"  required>';

        ?>
    </div>
    <div>
        <?php
        $dob = '<input type="date" name="dob" id="dob" value="%s" required>';
        echo sprintf($dob, $person['dob']);
        ?>
    </div>
    <div>
        <?php
        $firstName = sprintf('<input type="text" name="first_name" id="first_name" placeholder="First name" value="%s" required>
        ', $person['first_name']);
        echo $firstName;
        ?>
    </div>
    <div>
        <?php
        $lastName = '<input type="text" name="last_name" id="last_name" placeholder="Last name" value="%s" required>';
        echo sprintf($lastName, $person['last_name']);
        ?>
    </div>
    <div>
        <label for="telephone">For a number (123) 456-7890, format as 1234567890</label>
    </div>
    <div>
        <?php
        $tel = '<input type="tel" name="telephone" id="telephone" placeholder="Phone number" value="%d" required>';
        echo sprintf($tel, $person['telephone']);
        ?>
    </div>
    <div>
        <?php
        $email = '<input type="email" name="email" id="email" value="%s" placeholder="Enter email">';
        echo sprintf($email, $person['email']);
        ?>
    </div>
    <div>
        <?php
        $address = '<input type="text" name="address" id="address" value="%s" placeholder="Address" required>';
        echo sprintf($address, $person['address']);
        ?>
    </div>
    <div id="postal_code_div">
        <select name="postal_code" id="postal_code_select" required>
            <option value="" disabled>Select zip code/Postal code</option>
            <!-- Fetch codes from database -->
            <?php
            foreach ($postal_codes as $row) {
                foreach ($row as $key => $postal_code) {
                    if ($postal_code == '')
                        echo '<option selected value="' . $postal_code . '">' . $postal_code . '</option>';
                    else
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

