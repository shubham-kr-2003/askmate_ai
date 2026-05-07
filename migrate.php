<?php
include("db.php");

// Check karo column exist karta hai ya nahi
$check = mysqli_query($con, "SHOW COLUMNS FROM chats LIKE 'conversation_id'");

if (mysqli_num_rows($check) == 0) {
    // Column nahi hai, add karo
    $sql = "ALTER TABLE chats ADD conversation_id VARCHAR(50) NOT NULL DEFAULT '' AFTER user_id";
    if (mysqli_query($con, $sql)) {
        echo "<h3 style='color:green'>✅ Column 'conversation_id' successfully added!</h3>";
        echo "<p>Ab ap <a href='chat.php'>chat.php</a> par ja sakte hain.</p>";
    } else {
        echo "<h3 style='color:red'>❌ Error: " . mysqli_error($con) . "</h3>";
    }
} else {
    echo "<h3 style='color:orange'>⚠️ Column 'conversation_id' pehle se exist karta hai!</h3>";
    echo "<p>Ab ap <a href='chat.php'>chat.php</a> par ja sakte hain.</p>";
}
?>
