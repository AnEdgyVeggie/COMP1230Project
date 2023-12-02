<?php

<<<<<<< HEAD
=======
include_once("database-handler.php");


>>>>>>> 03e4bac4afc9ec165bfaabc3592b9d1c8d876dad
$aboutMe;
include_once("database-handler.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $aboutMe =  $_REQUEST['about-me'];
    
}

$userId = $_COOKIE['userId'];

$sql = "UPDATE users SET aboutMe = '$aboutMe' WHERE users.id = $userId;";
        
mysqli_query($connection, $sql);

header('Location: ../../pages/user-profile.php');
<<<<<<< HEAD

=======
>>>>>>> 03e4bac4afc9ec165bfaabc3592b9d1c8d876dad

?>
