<?php
// db.php - Database connection file
$servername = "localhost:3307"; 
$username = "root";
$password = "";
$dbname = "askmate_ai";

// Connection banana
$con = mysqli_connect($servername, $username, $password, $dbname);

// Connection check karna
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>