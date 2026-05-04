<?php 
session_start(); 
include("db.php"); 
if($_SERVER['REQUEST_METHOD'] =="POST") 
{ 
    $email = $_POST['email']; 
    $password = $_POST['password']; 
 
 
 
   if(!empty($email)&& !empty($password) && !is_numeric($email)) 
 { 
     $query = "select * from form where email= '$email' limit 1"; 
     $result = mysqli_query($con, $query); 
 
     
     if($result) 
     { 
        if($result && mysqli_num_rows($result)>0) 
        { 
             $user_data = mysqli_fetch_assoc($result); 
            if($user_data['password'] == $password) 
            { 
              header("location: chat.php"); 
       die; 
 
            } 
        } 
 
      } 
      echo"<script type='text/javascript'>alert('Wrong username or password')</script>"; 
   } 
   else{ 
    echo"<script type='text/javascript'>alert('Successfully Register')</script>"; 
   } 
} 
?> 
 
 
 
 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login</title> 
    <link rel="stylesheet" href="login.css"> 
</head> 
<body> 
 
    <nav class="navbar"> 
        <ul> 
            <li><a href="main.html">Home</a></li> 
            <li><a href="about.html">About</a></li> 
            <li><a href="services.html">Services</a></li>
                   <li><a href="Contact.html">Contact</a></li> 
        </ul> 
    </nav> 
 
    <div class="login"> 
        <h1>Login</h1> 
        <h4>Welcome back!</h4> 
        <form action="login.php" method="post"> 
            <label for="email">Email</label> 
            <input type="email" id="email" name="email" required> 
 
            <label for="password">Password</label> 
            <input type="password" id="password" name="password" minlenth="6" required> 
 
            <input type="submit" value="Login"> 
        </form> 
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p> 
    </div> 
 
</body> 
</html>