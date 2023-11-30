<?php
include_once("../assets\php\databaseHandler.php");

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
if (isset($_COOKIE['loggedIn'])) {

   echo  '<header>
            <nav>
                <span>
                    <a href="learningPaths.php">Learning Path HTML</a>|
                    <a href="../index.php">Home</a>
                </span>
                <span id="login">
                    <a onclick="logout();" href="" >Logout</a>
                </span>
            </nav>        
        </header>';

} else {
    echo '<header>
    <nav>
        <span>
            <a href="learningPaths.php">Learning Path HTML</a>|
            <a href="../index.php">Home</a>
        </span>
        <span id="login">
            <a href="register.php">Register</a>|
            <a href="">Login</a>
        </span>
    </nav>        
  </header>';
}

?>

    <?php
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

    <script>
    const logout = () => {
            document.cookie = "loggedIn=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "email=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "userId=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }
    }
    </script>
</body>
</html>