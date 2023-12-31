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
    <title>Login to Learning Paths</title>
</head>
<body >

<?php
    echo '<header>
    <nav>
        <span>
            <a href="learning-paths.php">Learning Paths</a>|
            <a href="../index.php">Home</a>
        </span>
        <span id="login">
            <a href="register.php">Register</a>|
            <a href="">Login</a>
        </span>
    </nav>        
  </header>';

        if (!empty($_GET)) {
            echo '<span>Registration Complete! Please login with your credentials</span>';
        }
    ?>
    <form>
        <label for="email">Email Address: </label>
        <input type="text" name="email" id="email">

        <label for="password">Password: </label>
        <input type="password" name="password" id="password">

        <div class="error-message">
            <p id="error" class="error"></p> 
       </div>
        
        <button type="button" onclick="getFormValues('login')">LOG IN</button>
    </form>
</body>
</html>