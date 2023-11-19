<?php
include_once("assets/php/databaseHandler.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Welcome to Learning Paths</title>
</head>
<body>
    <header>
        <nav>
            <span>
                <a href="pages/createPath.html">Create a Learning Path</a>|
                <a href="pages/learningPaths.php">View Learning Paths</a>
                <a href="pages/learning-path.html">Learning Path HTML</a>|

                <a href="">Home</a>
            </span>

            <span id="login">
                <a href="pages/register.php">Register</a>
                |
                <a href="pages/login.php">Login</a>
            </span>
        </nav>        
    </header>
    <p>
    <?php
    if (isset($_COOKIE["firstName"])) 
    {
        
        echo $_COOKIE["firstName"];
    }
    ?>

</body>
</html>