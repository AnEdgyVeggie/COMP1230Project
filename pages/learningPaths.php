<?php
    // if there is a query string in the URL (?loggedin=true), it will set 2 cookies for the entire site:
    // The users email, and a loggedIn=true, which will be used to keep the site facing a logged in user
    if (!empty($_GET)) {
        setcookie("email", $_COOKIE['email'], time() + 3600, '/');
        setcookie("loggedIn", true, time() + 3600, '/');
    }

    // include needs to be after the if statement above
    include "../assets/php/pathForm.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Learning Paths</title>
</head>
<body>

<?php
if (isset($_COOKIE['loggedIn']) || !empty($_GET)) {

   echo  '<header>
            <nav>
                <span>
                    <a href="">Learning Path HTML</a>|
                    <a href="../index.php">Home</a>
                </span>
                <span id="login">
                    <a onclick="logout();"  >Logout</a>
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




    <h1>Learning Paths</h1>

    <?php

        // for loop to loop through as many paths as is in the database maybe
        // showResources(1);

        // The above line is commented because without your database, the code was erroring, and therefor
        // the script tag below was not being called. For some reason I had to put the script in, because the 
        // JS file was not being imported for this specific function
    ?>

<script>
    const logout = () => {
        window.location.href = "../index.php";
        console.log("hello");
        document.cookie = "loggedIn=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "email=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
    </script>

</body>
</html>