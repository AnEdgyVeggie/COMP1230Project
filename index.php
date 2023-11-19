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
<<<<<<< HEAD:index.html
                <a href="pages/createPath.html">Create a Learning Path</a>|
                <a href="pages/learningPaths.php">View Learning Paths</a>
=======
                <a href="pages/learning-path.html">Learning Path HTML</a>|
>>>>>>> 4860f6b19bd1b203151a7534047a37383004ba0e:index.php
                <a href="">Home</a>
            </span>

            <span id="login">
<<<<<<< HEAD:index.html
                <a href="pages/register.html">Register</a>
                |
                <a href="pages/login.html">Login</a>
            </span>
        </nav>        
    </header>
    <p>
    <?php
    if (isset($_COOKIE["firstName"])) 
    {
        
        echo $_COOKIE["firstName"];
    }
    ?></p>
=======
                <a href="pages/register.php">Register</a>
                |
                <a href="pages/login.php">Login</a>
            </span>
        </nav>        
    </header>

>>>>>>> 4860f6b19bd1b203151a7534047a37383004ba0e:index.php
</body>
</html>