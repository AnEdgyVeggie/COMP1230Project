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
<?php
if (isset($_COOKIE['loggedIn'])) {

   echo  '<header>
            <nav>
                <span>
                    <a href="pages/learningPaths.php">Learning Paths</a>|
                    <a href="index.php">Home</a>|
                    <a href="pages/userProfile.php">Profile</a>
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
            <a href="pages/learningPaths.php">Learning Path HTML</a>|
            <a href="">Home</a>
        </span>
        <span id="login">
            <a href="pages/register.php">Register</a>|
            <a href="pages/login.php">Login</a>
        </span>
    </nav>        
  </header>';
}

?>

<h1>Welcome to Learning Paths!</h!>
<h2>We are so excited to see you.</h2>
<br><br>
<article>
    <p>
        At learning paths, we are excited to bring education content for users, by users
    We are a community focused education initiative that will empower those who want to give back, and offer 
    people who are looking for a free, community focused education.
    </p>
</article>
<article>
    <p>
        We encourage you to create an account, and register for some learning paths, but we also strongly encourage you
        to consider adding to our regiment of qualified instructors. Our motto at Learning Paths is to pay it forward 
        for a better, brighter tomorrow! Here you can be the change you want to see.
    </p>
</article>
<article>
    <p>
        Educational areas you can explore include but are not limited to:
    </p>
    <ul>
        <li>Full-Stack Software Engineering</li>
        <li>3D Modeling and Game design</li>
        <li>Knitting, for beginners to experts</li>
        <li>Cooking classes</li>
        <li>Building a great treehouse</li>
    </ul>
</article>
<script>
    const logout = () => {
        document.cookie = "loggedIn=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "email=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "userId=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
    </script>
</body>
</html>