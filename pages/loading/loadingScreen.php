<?php
include_once("../../assets/php/databaseHandler.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/loading.css">
    <title>Loading...</title>
</head>
<body>


    <!-- FOR LOADING SCREEN -->
    <div id="d5">
    </div>
    <div id="d4">
    </div>
    <div id="d3">
    </div>
    <div id="d2">
    </div>
    <div id="d1">
    </div>
    <h1> Your data is being loaded...</h1>
    <!-- -->

    <?php
    // !empty($_GET) is used because when loading is come to from registered
    // I passed a query string  whereas for login I did not

    if (!empty($_GET)) {
        $registered = false;
        $sql = 'SELECT * FROM users';
        
        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['emailAddress'] == $_COOKIE['email'])  {
                    echo '<script>
                    location.href = "../register.php"
                    alert("This email is already registered, \nplease register a new email \nor login instead")
                    </script>';
                    $registered = true;
                }
            }
            
        } if ($registered == false) {
            echo '<script>
            location.href = "../login.php?registered=true"
            alert("Registration success!")
            </script>';
            $first = $_COOKIE['firstName'];
            $last = $_COOKIE['lastName'];
            $email = $_COOKIE['email'];
            $pass = $_COOKIE['password'];
            $sql = "INSERT INTO users (firstName, lastName, emailAddress, password) VALUES
            ('$first', '$last', '$email', '$pass');";
            mysqli_query($connection, $sql);

        }

    } 

    if (empty($_GET)) {
        $loginSuccess = false;
        $sql = 'SELECT * FROM users';

        $result = mysqli_query($connection, $sql);
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['emailAddress'] == $_COOKIE['email'] 
                && $row['password'] == $_COOKIE['password']){
                    $loginSuccess = true;
                    echo '<script> 
                    location.href = "../learningPaths.php?loggedIn=true";
                    </script>';
                    setcookie('userId', $row['id'], time()+30*1000, '/', "", false, true);
                }
            }
        }
        if (!$loginSuccess) {

            echo '<script> 
            alert("Incorrect username or password");
            location.href = "../login.php";
            </script>';
        }
    }
    ?> 
</body>
</html>