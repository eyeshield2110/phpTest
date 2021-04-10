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
    echo "<h1>Add a person (successful connection to db)</h1>" . "<br>";
}
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
<div>
    <a href="CRUD.php">Search for a person</a>
</div>

<!-- person form - if postal is not in db yet, add it -->
<!-- how to handle error: if entering the wrong city for a postal code that exist for a different city? -->
<form action="post_page.php" method="post">
    <div>
        <input type="text" name="medicare" id="medicare" placeholder="Enter medicare number">
    </div>
    <div>
        <input type="date" name="dob" id="dob">
    </div>
    <div>
        <input type="text" name="first_name" id="first_name" placeholder="First name">
    </div>
    <div>
        <input type="text" name="last_name" id="last_name" placeholder="Last name">
    </div>
    <div>
        <label for="telephone">For a number (123) 456-7890, format as 1234567890</label>
    </div>
    <div>
        <input type="tel" name="telephone" id="telephone" placeholder="Phone number">
    </div>
    <div>
        <input type="email" name="email" id="email" placeholder="Enter email">
    </div>
    <div>
        <input type="text" name="address" id="address" placeholder="Address">
    </div>
    <div id="postal_code_div">
        <select name="postal_code" id="postal_code_select" required>
            <option disabled selected>Select zip code/Postal code</option>
            <!-- Fetch codes from database -->
        </select>
        <input style="display: none;" type="text" name="postal_code" id="postal_code_input" placeholder="Zip code/Postal code">
        <button id="toggle_code" onclick="toggle('postal_code')">Add postal code</button>
    </div>
    <div id="city_div">
        <select name="city" id="city_select" required>
            <option disabled selected>Select city</option>
            <!-- Fetch city from database -->
        </select>
        <input style="display: none;"  type="text" name="city" id="city_input" placeholder="City">
        <button id="toggle_city" onclick="toggle('city')">Add city</button>
    </div>
    <div>
        <select required name="province" id="province">
            <option value="" selected disabled>Select a province</option>
            <!-- Fetch provinces from database -->
            <?php
            foreach ($provinces as $row) {
                foreach ($row as $key => $province) {
                    echo '<option value="' . $province . '">' . $province . '</option>';
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
    <div>
        <input type="submit">
    </div>

</form>

<script>
    function toggle(field) {
        let element = document.getElementById(field + '_div')
        let select = element.getElementsByTagName('select')[0]
        let input = element.getElementsByTagName('input')[0]
        if (select.style.display !== 'none') {
            // hide select and show input (add new)
            select.style.display = 'none'
            input.style.display = 'inline-block'
        } else {
            // hide input and show elect (select from existing)
            select.style.display = 'inline-block'
            input.style.display = 'none'
        }
        /*
        switch(field) {
            case 'postal_code':
            {
                let city_div = document.getElementById('city_div')
                city_div.display.
            }
                break
        }
        */
    }
    function preventLoad(event){
        event.preventDefault()
    }

    function validPostalCode() {
        let postal_code = document.getElementById('postal_code')

    }

    function loadCities() {
        let selected_province = document.getElementById('').value
        <?php
        ?>
    }

</script>
