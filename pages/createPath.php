<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../assets/js/learning-path.js" defer></script>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <?php
        if (isset($_COOKIE['loggedIn']) || !empty($_GET)) {

            echo  '<header>
                    <nav>
                        <span>
                            <a href="learningPaths.php">Learning Paths</a>|
                            <a href="createPath.php">Create a Learning Path</a>|
                            <a href="../index.php">Home</a>
                        </span>
                        <span id="login">
                            <a onclick="logout();">Logout</a>
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
                    <a href="login.php">Login</a>
                </span>
            </nav>        
        </header>';
        }
    ?>

    <p>Create a Learning Path</p>
    <br>

    <form method="post" action="../assets/php/pathForm.php" id="learning-path-form">
        <label for="path_name">Learning Path Name</label>
        <input type="text" id="path_name" name="path_name">

        <label for="path_desc">Path Description</label>
        <textarea id="path_desc" name="path_desc" cols="30" rows="10"></textarea>

        <label for="given_resources" id="given_resources" name="given_resources">Resources</label>
        <input type="button" id="add-button" value="Add">
        <br>
        <input type="number" name="counter" id="counter" readonly="true" hidden="true">
        <br>
        <br>
        <a href="learningPaths.php"><input type="submit"></a>
    </form>
    
</body>
</html>