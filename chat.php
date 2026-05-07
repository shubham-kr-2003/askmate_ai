<?php 
include('db.php');
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

 
    <title>AskMate-AI</title> 
    <link rel="stylesheet" href="chat.css"> 
</head> 
<body> 
 <div class="main-wrapper">
    <div class="sidebar">
        <button class="new-chat-btn" onclick="startNewChat()">
            <span>+</span> New Chat
        </button>
        <h2>Recent Chats</h2>
        <ul id="chat-history">
            <!-- History items will be loaded here via JS -->
        </ul>
    </div>
    
    <div class="content">
        <header class="chat-header">
            <h3>AskMate AI</h3>
            <a href="logout.php" class="logout-button">Logout</a> 
        </header>

        <div class="chat-container" id="chat-container"> 
            <div class="welcome-container" id="welcome-message">
                <h1>Hello There!</h1>
                <p>How can I help you today?</p>
            </div>
        </div> 

        <div class="prompt-area"> 
            <div class="input-wrapper">
                <input type="text" class="prompt" id="user-input" placeholder="Message AskMate AI..."> 
                <button class="btn" id="send-btn">
                    <img src="send.svg" alt="send">
                </button> 
            </div>
            <p style="font-size: 10px; color: #666; text-align: center; margin-top: 10px;">
                AskMate AI can make mistakes. Check important info.
            </p>
        </div> 
    </div>
 </div>
 <script src="script.js"></script>    
</body> 
</html>