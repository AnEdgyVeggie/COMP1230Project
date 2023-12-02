<?php


// if there is a query string in the URL (?loggedin=true), it will set 2 cookies for the entire site:
// The users email, and a loggedIn=true, which will be used to keep the site facing a logged in user
if (!empty($_GET)) {
    include("../assets/php/database-handler.php");

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
    header('Location: user-profile.php');
}

include("../assets/php/database-handler.php");
$id = $_COOKIE['userId'];
$sql = "SELECT * FROM users WHERE id = $id";
        
$result = mysqli_query($connection, $sql);

$firstName; $lastName; $email; $aboutMe; $image; 


while ($row = mysqli_fetch_assoc($result)) { 
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $email = $row['emailAddress'];
        $aboutMe = $row['aboutMe'];
        $image = $row['image'];
}


echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/user-profile.css">
        <title>User Profile</title>
    </head>';
        echo '<header>
                 <nav>
                     <span>
                         <a href="learning-paths.php">Learning Paths</a>|
                         <a href="../index.php">Home</a>|
                         <a href="">Profile</a>
                     </span>
                     <span id="login">
                         <a onclick="logout();" >Logout</a>
                     </span>
                 </nav>        
             </header>';


             // PERSONAL HEADER
echo '<body>
        <div id="userHeading">
            <div id="picture-form">';
            
            if ($image == null) {
                echo '<img id="profilePic" src="../assets/photos/default.jpg" alt="user image" width="240px" height="240px">';
            } else {
                $path = $image;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path);
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                echo '<img  id="profilePic" src="'.$base64.'" alt="user image" width="240px" height="240px"/>';

                }

                # the text area is hidden from view as it is only used to send image data to the back end without using
                # additional libraries

            echo '<form id="input-image" method="POST" action="../assets/php/submit-photo.php">
                    <label>Change profile picture</label>
                    <div id="form-layout">
                    <input type="file" id="file" accept="image/jpeg" name="image">
                    <textarea id="image-text" name="imageText"></textarea> 
                    <button type="submit">Submit</button>
                    </div>
                </form>

            </div>

            <h1> ' . $firstName . " " . $lastName . '</h1>
        </div>

        <script>
            let inputDiv = document.querySelector("#input-image"),
            input = document.querySelector("#input-image input");

            input.addEventListener("change", () => {
                const file = input.files[0];
                console.log(file);
                const reader = new FileReader();


                reader.addEventListener("load", () =>{ 
                    console.log(reader.result);
                    document.querySelector("#image-text").innerHTML = reader.result;
                })

                reader.readAsDataURL(file);


            })
      
        </script>
';

        // ABOUT ME
        if ($aboutMe == "") {
            echo '
            <form id="about-me" method="POST" action="../assets/php/submit-about-me.php">
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

        
        // PATHS
        include_once('../assets/php/path-functions.php');
        $id = $_COOKIE['userId'];
        $sql = "SELECT * FROM paths WHERE user_id = $id";
        $result = mysqli_query($connection, $sql);

        echo "<div id='pathsGrid'>";
        while ($pathArray = mysqli_fetch_assoc($result)) {
            $pathId = $pathArray['path_id'];
            debug_to_console($pathId);
            showResources($pathId);
        };
        echo "</div>";

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

