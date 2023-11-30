<?php
include_once("../assets/php/databaseHandler.php");

$sql = "SELECT * FROM users";
        
$result = mysqli_query($connection, $sql);

$firstName; $lastName; $email; $aboutMe; 

while ($row = mysqli_fetch_assoc($result)) { 
    if ($row['id'] == $_COOKIE['userId']) {
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['emailAddress'];
        $aboutMe = $row['aboutMe'];
    }
}

echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/userProfile.css">
        <script src="../assets/js/userProfile.js" defer></script>
        <title>User Profile</title>
    </head>';
    if (isset($_COOKIE['loggedIn'])) {

        echo  '<header>
                 <nav>
                     <span>
                         <a href="learningPaths.php">Learning Path HTML</a>|
                         <a href="../index.php">Home</a>
                     </span>
                     <span id="login">
                         <a onclick="logout();" >Logout</a>
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
                 <a href="">Register</a>|
                 <a href="login.php">Login</a>
             </span>
         </nav>        
       </header>';
     }



echo '<body>
        <div id="userHeading">
            <img id="profilePic" src="../assets/photos/default.jpg" alt="user image" width="240px" height="240px">
            <h1> ' . $firstName . " " . $lastName . '</h1>
        </div>';

        if ($aboutMe == "") {
            echo '
            <form id="about-me" method="POST" action="../assets/php/submitAboutMe.php">
                <label for="about-me">Please Enter Your About Me</label>
                <textarea cols="80" rows="10" id="about-me" name="about-me" ></textarea>

                <input type="submit" >
            </form>';
        } else {
            echo '
            <span id="aboutme">
                '. $aboutMe .'
            </span>
            ';
        }
        ?>
        <script>
        const logout = () => {
            location.href = "login.php";
            document.cookie = "loggedIn=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "email=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            document.cookie = "userId=''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

        }
        </script>


   </body>
    </html>;

