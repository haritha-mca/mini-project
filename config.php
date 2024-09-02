<?php
$host = 'localhost';  // Your database host
$user = 'root';        // Your database username
$password = '';        // Your database password (if any)
$dbname = 'medalert';  // Your database name

// Create connection
$con = mysqli_connect($host, $user, $password, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
