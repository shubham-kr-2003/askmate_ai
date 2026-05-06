<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $message = mysqli_real_escape_string($con, $_POST['message']);
    $role = mysqli_real_escape_string($con, $_POST['role']);

    $query = "INSERT INTO chats (user_id, message, role) VALUES ('$user_id', '$message', '$role')";
    if (mysqli_query($con, $query)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['error' => mysqli_error($con)]);
    }
}
?>
