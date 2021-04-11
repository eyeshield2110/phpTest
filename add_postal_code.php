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
// fetch the cities
$cities_query = 'SELECT name FROM city';
$cities_result = $mysqli->query($cities_query);
$cities = [];
while ($row = $cities_result->fetch_assoc()) {
    $cities[] = $row;
}
?>

<h3>Add a postal code</h3>
<form action="post_page.php" method="post">
    <div>
        <input type="text" name="postal_code" id="postal_code_input" placeholder="Zip code/Postal code">
    </div>
    <div id="city_div">
        <select name="city" id="city_select" required>
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
    <input type="hidden" name="table" value="postalCode">
    <div>
        <input type="submit">
    </div>
</form>

<?php
include 'links_partials.php';
?>