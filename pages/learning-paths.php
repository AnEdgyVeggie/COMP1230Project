<?php
    // if there is a query string in the URL (?loggedin=true), it will set 2 cookies for the entire site:
    // The users email, and a loggedIn=true, which will be used to keep the site facing a logged in user
    if (!empty($_GET)) {
        $dbServerName = "localhost:3306";
        $dbUsername = "f3479568";
        $dbPassword = "CSESmmcc4!!";
        $dbName = "f3479568_project";
        $connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

        setcookie("loggedIn", true, time() + 3600, '/');

        $sql = 'SELECT * FROM users';
        
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['emailAddress'] == $_COOKIE['email'])  {
                    setcookie('userId', $row['id'], time()+30*1000, '/');
                }
            }
            
        }

    }

    // include needs to be after the if statement above
    include("../assets/php/path-functions.php");
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

   echo '<header>
            <nav>
                <span>
                    <a href="learning-paths.php">Learning Paths</a>|
                    <a href="create-path.php">Create a Learning Path</a>|
                    <a href="../index.php">Home</a>|
                    <a href="user-profile.php">Profile</a>
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
            <a href="learning-paths.php">Learning Paths</a>|
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
    <div id="pathsGrid">
        <?php
            // Only show resources if the given ID is not null.
            // Accounts for path deletions.
            for ($i = 0; $i < getPathAmounts()['total'] + 1; $i++) {
                if (showResources($i + 1) == null) {
                    continue;
                } else {
                    showResources($i);
                }
            }
        ?>
    </div>

<script>
    const logout = () => {
            location.href = "login.php";
            document.cookie = "loggedIn=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "email=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "userId=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }
    </script>
</body>
</html>