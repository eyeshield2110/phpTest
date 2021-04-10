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
    echo "<h1>Add a city</h1>" . "<br>";
}
?>
<?php
// fetch the regions
$regions_query = 'SELECT name FROM region';
$regions_result = $mysqli->query($regions_query);
$regions = [];
while ($row = $regions_result->fetch_assoc()) {
    $regions[] = $row;
}
?>

<form>
    <div>
        <input type="text" name="city" id="city_input" placeholder="City">
    </div>
    <div id="region_div">
        <select name="region" id="region_select">
            <option value="" disabled selected>Select region</option>
            <!-- Fetch region from database -->
            <?php
            foreach ($regions as $row) {
                foreach ($row as $key => $region) {
                    echo '<option value="' . $region . '">' . $region . '</option>';
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