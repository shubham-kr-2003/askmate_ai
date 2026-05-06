<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
// Fetch unique user messages as history items
$query = "SELECT DISTINCT message, created_at FROM chats WHERE user_id = '$user_id' AND role = 'user' ORDER BY created_at DESC LIMIT 20";
$result = mysqli_query($con, $query);

$history = [];
while ($row = mysqli_fetch_assoc($result)) {
    $history[] = $row;
}

echo json_encode($history);
?>
