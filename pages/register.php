<?php
include_once("../assets\php\database-handler.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/authentication.js" defer></script>
    <title>Register For Learning Paths</title>
</head>
<body>
<?php

    echo '<header>
    <nav>
        <span>
            <a href="learning-paths.php">Learning Paths</a>|
            <a href="../index.php">Home</a>
        </span>
        <span id="login">
            <a href="">Register</a>|
            <a href="login.php">Login</a>
        </span>
    </nav>        
  </header>';


?>
    <form id="register-form">
        <div class="fields">
            <label for="firstname">First Name: </label>
            <input type="text" name="firstname" id="firstname" placeholder="First Name">
        </div>
        <div class="error-message">
             <p id="error-fname" class="error"></p> 
        </div>

        <div class="fields">
            <label for="lastname">Last Name: </label>
            <input type="text" name="lastname" id="lastname" placeholder="Last Name">
        </div>
        <div class="error-message">
            <p id="error-lname" class="error"></p> 
        </div>

        <div class="fields">
            <label for="email">Email Address: </label>
            <input type="text" name="email" id="email" placeholder="JohnDoe@example.com">
        </div>
        <div class="error-message">
            <p id="error-email" class="error"></p>
        </div>

        <div class="fields">          
            <label for="password">Password: </label>
            <input type="password" name="password" id="password" placeholder="********">
        </div>
        <div class="error-message">
            <p id="error-password" class="error"></p>
        </div>

        <div class="fields">
            <label for="confirm_password">Confirm Password: </label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="********">
        </div>
        <div class="error-message">
            <p id="error-confirmpw" class="error"></p>
        </div>
        <!-- <button type="submit" onclick="getFormValues('register')"></button> -->
        <button type="button" onclick="getFormValues('register')">REGISTER</button>
    </form>

</body>
</html>