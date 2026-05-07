<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id']) || !isset($_GET['conversation_id'])) {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$user_id = $_SESSION['user_id'];
$conversation_id = mysqli_real_escape_string($con, $_GET['conversation_id']);

$query = "SELECT message, role FROM chats WHERE user_id = '$user_id' AND conversation_id = '$conversation_id' ORDER BY created_at ASC";
$result = mysqli_query($con, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
