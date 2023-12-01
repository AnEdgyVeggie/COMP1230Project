<?php 
$image;


include_once("databaseHandler.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $image = $_REQUEST['imageText'];
    
}
$userId = $_COOKIE['userId'];
$sql = "UPDATE Users SET image = '$image' WHERE users.id = $userId;";
        
mysqli_query($connection, $sql);

header('Location: ../../pages/userProfile.php');
?>