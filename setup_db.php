<?php
include("db.php");

// 'form' table banana (users ke liye)
$sql_form = "CREATE TABLE IF NOT EXISTS form (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    contact VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql_form)) {
    echo "Table 'form' created successfully.<br>";
} else {
    echo "Error creating table 'form': " . mysqli_error($con) . "<br>";
}

// 'chats' table banana (with conversation_id)
$sql_chats = "CREATE TABLE IF NOT EXISTS chats (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) NOT NULL,
    conversation_id VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    role ENUM('user', 'ai') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($con, $sql_chats)) {
    echo "Table 'chats' created or checked.<br>";
    
    // Check karna ki column hai ya nahi
    $check_column = mysqli_query($con, "SHOW COLUMNS FROM chats LIKE 'conversation_id'");
    if (mysqli_num_rows($check_column) == 0) {
        // Agar nahi hai toh add karna
        if(mysqli_query($con, "ALTER TABLE chats ADD conversation_id VARCHAR(50) NOT NULL AFTER user_id")) {
            echo "Column 'conversation_id' added successfully.<br>";
        } else {
            echo "Error adding column: " . mysqli_error($con) . "<br>";
        }
    } else {
        echo "Column 'conversation_id' already exists.<br>";
    }
} else {
    echo "Error creating table 'chats': " . mysqli_error($con) . "<br>";
}
?>
