<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
// Har unique conversation_id ki pehli message ko title ki tarah uthana
$query = "SELECT conversation_id, MIN(message) as title, MAX(created_at) as last_chat 
          FROM chats 
          WHERE user_id = '$user_id' 
          GROUP BY conversation_id 
          ORDER BY last_chat DESC 
          LIMIT 20";
$result = mysqli_query($con, $query);

$history = [];
while ($row = mysqli_fetch_assoc($result)) {
    $history[] = $row;
}

echo json_encode($history);
?>
