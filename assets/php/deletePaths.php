<?php
include('pathFunctions.php');
include('databaseHandler.php');
// Grabs user id from the page, then the password from the db.
$userId = $_COOKIE['userId'];
$result = mysqli_query($connection, "SELECT password FROM users WHERE $userId = users.id");
$password = mysqli_fetch_assoc($result);
// Grabs the password entered on previous page.
$confirmPassword = $_POST['confirmPassword'];

// Grabs the ids needed for the function if the password is correct.
$pathId = $_POST['pathId'];
$resourceId = $_POST['resourceId'];

// If password matches the one in the db...
if ($confirmPassword == $password['password']) {
    include('confirmDelete.php');
    echo "Path deleted. <br><br>";
    // Delete the path...
    deletePath($pathId, $resourceId);
    // ... and offer a trip back to the learning paths page.
    echo "
    <form action='../../pages/learningPaths.php' method='post'>
        <label for='return'>Return to Learning Paths?</label>
        <input type='submit' value='Return to Learning Paths'>
    </form>
";
} else { // If password is incorrect...
    include_once('confirmDelete.php');
    // Show error, prompt for return to previous page or allow user to retry.
    echo "Incorrect password. Please try again or return to the previous page. <br><br>";
    echo "
        <form action='../../pages/learningPaths.php' method='post'>
            <label for='return'>Return to Learning Paths?</label>
            <input type='submit' value='Return to Learning Paths'>
        </form>
    ";
}













