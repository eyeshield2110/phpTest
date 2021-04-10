<style>
    table, td, th, tr {
        border: solid black 1px;
    }

    div {
        padding: 5px;
        margin: 5px;
    }
    .hidden-choice {
        display:none;
    }
</style>
<?php
$mysqli = new mysqli("192.168.0.106", "uec353_4", "c0NcR6iA", "test");

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
} else {
    echo "<h1>Add a region</h1>" . "<br>";
}
// fetch the provinces and cities in the db
$provinces_query = 'SELECT name FROM province';
$provinces_result = $mysqli->query($provinces_query);
$provinces = [];
while ($row = $provinces_result->fetch_assoc()) {
    $provinces[] = $row;
}
?>
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