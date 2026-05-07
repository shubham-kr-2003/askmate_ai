<?php
// db.php - Database connection file
$servername = "localhost"; 
$username = "root";
$password = ""; // XAMPP Shell se: mysqladmin -u root password ""
$dbname = "askmate_ai";

// Connection banana
$con = mysqli_connect($servername, $username, $password, $dbname);

// Connection check karna
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>