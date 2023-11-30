<?php

include_once("databaseHandler.php");


$aboutMe;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $aboutMe =  $_REQUEST['about-me'];
    
}

$userId = $_COOKIE['userId'];

$sql = "UPDATE Users SET aboutMe = '$aboutMe' WHERE users.id = $userId;";
        
mysqli_query($connection, $sql);

header('Location: ../../pages/userProfile.php');

?>
