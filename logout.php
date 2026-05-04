<?php
session_start();
session_destroy(); // Saare login sessions khatam karne ke liye
header("Location: login.php"); // Wapas login page par bhejna
exit();
?>