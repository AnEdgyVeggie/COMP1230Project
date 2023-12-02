<?php
include_once('path-functions.php');
$dbServerName = "localhost:3306";  // this SHOULD be fine to leave
$dbUsername = "f3443253"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
$dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
$dbName = "f3443253_project"; // this is the name of the database, yours will be f3######_databaseName

// Connection info.
$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

$pathId = $_POST['pathId'];
$resourceString = $_POST['resourceList'];
$resourceArray = explode(',', $resourceString);

$indexes = count($resourceArray);
$resourceToSearch = '';
$postedIndex;

for ($i = 0; $i < $indexes; $i++) {
    if (isset($_POST['resource' . $i])) {
        $resourceToSearch = $_POST['resource' . $i];

        $indexTest = $i;

        if ($indexTest == array_search($resourceToSearch, $resourceArray)) {
            $postedIndex = array_search($resourceToSearch, $resourceArray);
        }
    }
}

$sqlLikequery = "UPDATE resource_likes SET likes = (likes+1) 
                 WHERE resource_index = $postedIndex AND path_id = $pathId;";

mysqli_query($conn, $sqlLikequery);
header('Location: ../../pages/learning-paths.php');