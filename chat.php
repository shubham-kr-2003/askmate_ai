<?php 
include('db.php') 
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
 <div class="container"> 
    <h1>HELLO THERE!</h1> 
    <h2>Talk to your AskMate</h2> 
    <a href="login.php" class="logout-button">Logout</a> 
 
 </div>   
 <div class="prompt-area"> 
<input type="text" class="prompt" placeholder="Ask Something...."> 
<button class="btn"><img src="send.svg" alt="btn"></button> 
 
 </div> 
   
<div class="chat-container"> 
</div> 
 <script src="script.js"></script>    
</body> 
</html>