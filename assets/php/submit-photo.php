<?php 
$image;


include_once("database-handler.php");
<<<<<<< HEAD
=======

>>>>>>> 03e4bac4afc9ec165bfaabc3592b9d1c8d876dad

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $image = $_REQUEST['imageText'];
    
}
$userId = $_COOKIE['userId'];
$sql = "UPDATE users SET image = '$image' WHERE users.id = $userId;";
        
mysqli_query($connection, $sql);

header('Location: ../../pages/user-profile.php');
?>