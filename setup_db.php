<?php
include("db.php");

$sql = "CREATE TABLE IF NOT EXISTS chats (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    message TEXT NOT NULL,
    role ENUM('user', 'ai') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql)) {
    echo "Table 'chats' created successfully or already exists.";
} else {
    echo "Error creating table: " . mysqli_error($con);
}
?>
