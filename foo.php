<HTML>
<HEAD>
	<TITLE>Date/Time Functions Demo</TITLE>
</HEAD>
<BODY>




<?php
$mysqli = new mysqli("uec353.encs.concordia.ca","uec353_4","c0NcR6iA","uec353_4");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
} else {
echo "Successful connection to db!" . "<br>";
}

// Testing queries
 
$name = "Noah";

$query = sprintf("SELECT id, name FROM demo WHERE name='%s'", $name);
$result = $mysqli->query($query);

// Check result
if ($result->num_rows > 0) {
// function num_rows() checks number of rows in result
    while($row = $result->fetch_assoc()) {
      echo "id: " . $row["id"]. " - Name " . $row["name"] . "<br>"; 
    }
} else {
    echo "Zero results";
}
$mysqli->close();
?>



<H1>Date/Time Functions Demo</H1>
<P>The current date and time is
<EM><?echo date('D M d, Y H:i:s', time())?></EM>
<P>Current PHP version:
<EM><?echo phpversion()?></EM>
</BODY>
</HTML>
