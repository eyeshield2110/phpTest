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
// fetch the provinces and cities in the db
$provinces_query = 'SELECT name FROM province';
$provinces_result = $mysqli->query($provinces_query);
$provinces = [];
while ($row = $provinces_result->fetch_assoc()) {
    $provinces[] = $row;
}
?>

<h3>Add a region</h3>
<form action="post_page.php" method="post">
    <div>
        <input type="text" name="region" placeholder="Add a region">
    </div>
    <div>
        <select name="province" id="province" required>
            <option selected disabled value="">Select a province</option>
            <?php
            foreach ($provinces as $row) {
                foreach ($row as $key => $province) {
                    echo '<option value="' . $province  .'">'. $province . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <input type="hidden" name="table" value="region">
    <div>
        <input type="submit">
    </div>

</form>

<?php
include 'links_partials.php';
?>