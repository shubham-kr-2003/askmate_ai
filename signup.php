<?php 
session_start(); 
include("db.php"); 
if($_SERVER['REQUEST_METHOD'] =="POST") 
{ 
    $firstname = $_POST['first_name']; 
    $lastname = $_POST['last_name']; 
    $contact = $_POST['contact']; 
    $email = $_POST['email']; 
     $password = password_hash($_POST['password'], 
    PASSWORD_DEFAULT); 
 
   if(!empty($email)&& !empty($password) && !is_numeric($email)) 
   { 
     $query = "insert into form (first_name,last_name,contact,email,password) values ('$firstname', 
'$lastname', '$contact', '$email', '$password')"; 
     mysqli_query($con, $query); 
     echo"<script type='text/javascript'>alert('Successfully Register')</script>"; 
   } 
    else{ 
     echo"<script type='text/javascript'>alert('Please Enter Some Valid information')</script>"; 
 
    } 
} 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Sign Up</title> 
    <link rel="stylesheet" href="signup.css"> 
</head> 
<body> 
    <nav class="navbar"> 
        <ul> 
            <li><a href="main.html">Home</a></li> 
            <li><a href="about.html">About</a></li> 
            <li><a href="services.html">Services</a></li> 
            <li><a href="contact.html">Contact</a></li> 
        </ul> 
    </nav> 
 
    <div class="signup"> 
        <h1>Sign Up</h1> 
        <h4>It's free and only takes a minute</h4> 
 
        <form action="signup.php" method="post"> 
            <label for="first_name">First Name</label> 
            <input type="text" id="first_name" name="first_name" required> 
 
            <label for="last_name">Last Name</label> 
            <input type="text" id="last_name" name="last_name" required> 
 
            <label for="contact">Contact Number</label> 
            <input type="tel" id="contact" name="contact" maxlength="10" required >
             <label for="email">Email</label> 
            <input type="email" id="email" name="email" required> 
 
            <label for="password">Password</label> 
            <input type="password" id="password" name="password" minlength="8" required> 
 
            <input type="submit" value="Submit"> 
        </form> 
 
        <p>By clicking the Sign Up button, you agree to our  
            <a href="#">Terms and Conditions</a> and  
            <a href="#">Privacy Policy</a>. 
        </p> 
        <p>Already have an account? <a href="login.php">Login here</a></p> 
    </div> 
</body> 
</html>