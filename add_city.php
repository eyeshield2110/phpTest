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
// fetch the regions
$regions_query = 'SELECT name FROM region';
$regions_result = $mysqli->query($regions_query);
$regions = [];
while ($row = $regions_result->fetch_assoc()) {
    $regions[] = $row;
}
?>

<h3>Add a city</h3>
<form action="post_page.php" method="post">
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
    <input type="hidden" name="table" value="city">
    <div>
        <input type="submit">
    </div>
</form>

<?php
include 'links_partials.php';
?>