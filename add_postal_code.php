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
$mysqli = new mysqli("192.168.0.106", "uec353_4", "c0NcR6iA", "test");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
} else {
    echo "<h1>Add a postal code</h1>" . "<br>";
}
?>

<?php
// fetch the cities
$cities_query = 'SELECT name FROM city';
$cities_result = $mysqli->query($cities_query);
$cities = [];
while ($row = $cities_result->fetch_assoc()) {
    $cities[] = $row;
}
?>
<form>
    <div>
        <input type="text" name="postal_code" id="postal_code_input" placeholder="Zip code/Postal code">
    </div>
    <div id="city_div">
        <select name="city" id="city_select">
            <option value="" disabled selected>Select city</option>
            <!-- Fetch city from database -->
            <?php
            foreach ($cities as $row) {
                foreach ($row as $key => $city) {
                    echo '<option value="' . $city . '">' . $city . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <div>
        <input type="submit">
    </div>
</form>

<?php
include 'links_partials.php';
?>