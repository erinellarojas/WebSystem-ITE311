<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms_buhisan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL database 'lms_buhisan'.";

// Test query
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<br>Tables in database:<br>";
    while($row = $result->fetch_assoc()) {
        echo $row["Tables_in_lms_buhisan"] . "<br>";
    }
} else {
    echo "<br>No tables found.";
}

$conn->close();
?>
