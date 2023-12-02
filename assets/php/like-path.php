<?php
include("../assets/php/database-handler.php");

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