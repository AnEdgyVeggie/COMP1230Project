<?php

$aboutMe;
include_once("database-handler.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $aboutMe =  $_REQUEST['about-me'];
    
}

$userId = $_COOKIE['userId'];

$sql = "UPDATE users SET aboutMe = '$aboutMe' WHERE users.id = $userId;";
        
mysqli_query($connection, $sql);

header('Location: ../../pages/user-profile.php');


?>
