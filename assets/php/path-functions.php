<?php 
// Push resources function.
function pushResources($edit, $pathUser, $pathName, $pathDescription, $pathResources, $pathId = 1) {
    // DB info.
    $dbServerName = "localhost:3306";  // this SHOULD be fine to leave
    $dbUsername = "f3443253"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
    $dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
    $dbName = "f3443253_project"; // this is the name of the database, yours will be f3######_databaseName

    // Connection info.
    $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

    // Separate elements into comma separated list.
    $resourceString = implode(',', $pathResources);

    // ******* RESOURCE ID MANAGEMENT ********
    // Grab existing resource IDs.
    $sqlSelectResourceId = "SELECT resource_id FROM resources;";
    $existingResourceIds = mysqli_query($conn, $sqlSelectResourceId);

    // Grab existing resources.
    $sqlSelectResources = "SELECT resource_list FROM resources;";
    $existingResourceString = mysqli_query($conn, $sqlSelectResources);

    $array = array();

    while ($row = mysqli_fetch_assoc($existingResourceString)) {
        $test =  $row['resource_list'];
        $explodedString = explode(',', $test);
        array_push($array, $explodedString);
    }

    
    // New resource id.
    $newResourceId = 1;
    // Existing resource ids.
    $resourceIds = array();
    while ($row = mysqli_fetch_assoc($existingResourceIds)) {
        array_push($resourceIds, $row['resource_id']);
    }

    // For as many resource ids that exist...
    for ($i = 0; $i < count($resourceIds); $i++) {
        if ($resourceIds[$i] == $newResourceId) {
            $newResourceId++;
        } 
    }

    // ******* PATH ID MANAGEMENT ********
    // Grab existing path IDs.
    $sqlSelectPathIds = "SELECT path_id FROM paths";
    $existingPathIds = mysqli_query($conn, $sqlSelectPathIds);
    
    // New path id.
    $newPathId = 1;
    // Existing path ids.
    $pathIds = array();
    while ($row = mysqli_fetch_assoc($existingPathIds)) {
        array_push($pathIds, $row['path_id']);
    }

    // For as many path ids that exist...
    // This is to keep path ids and resource ids lined up.
    for ($i = 0; $i < count($pathIds); $i++) {
        if ($pathIds[$i] == $newPathId) {
            $newPathId++;
        }
    }

    // Count of resources in array.
    $arrayCount = count($pathResources);
    $existingCount = count(getExistingValues($pathId)[0]['existingResources'][0]);

    if ($edit) {
        // Update queries.
        $sqlUpdatePath = "UPDATE paths SET path_id = $pathId, user_id = $pathUser, 
                          path_name = '$pathName', path_desc = '$pathDescription', 
                          resource_id = $pathId WHERE path_id = $pathId";

        $sqlUpdateResource = "UPDATE resources SET resource_id = $pathId, 
                              path_id = $pathId, resource_list = '$resourceString' WHERE resource_id = $pathId";
        // Insert the likes per each new edit.
        for ($i = $existingCount; $i < $arrayCount; $i++) {
            $sqlLikeInsert = "INSERT INTO resource_likes (path_id, resource_index, likes)
            VALUES ($pathId, $i , 0)";
            mysqli_query($conn, $sqlLikeInsert);
        }

        mysqli_query($conn, $sqlUpdatePath);
        mysqli_query($conn, $sqlUpdateResource);
        
    } else {
        // Insert queries.
        $sqlPathInsert = "INSERT INTO paths (path_id, user_id, path_name, path_desc, resource_id)
                        VALUES ('$newPathId', '$pathUser', '$pathName', '$pathDescription', '$newResourceId');";

        $sqlResourceInsert = "INSERT INTO resources (resource_id, path_id, resource_list)
                            VALUES ('$newPathId', '$newPathId', '$resourceString')";

        for ($i = 0; $i < $arrayCount; $i++) {
            $sqlLikeInsert = "INSERT INTO resource_likes (path_id, resource_index, likes)
            VALUES ($newPathId, $i, 0)";

            mysqli_query($conn, $sqlLikeInsert);
        }

        
        mysqli_query($conn, $sqlPathInsert);
        mysqli_query($conn, $sqlResourceInsert);
    }

}
// Show resources function.
function showResources($pathId) {
    $dbServerName = "localhost:3306";  // this SHOULD be fine to leave
    $dbUsername = "f3443253"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
    $dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
    $dbName = "f3443253_project"; // this is the name of the database, yours will be f3######_databaseName

    // Connection info.
    $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

    // Queries.
    $sqlSelectPaths =  "SELECT * FROM paths p 
                        JOIN resources r 
                        ON p.resource_id = r.resource_id
                        JOIN users u
                        ON u.id = p.user_id
                        WHERE p.path_id = $pathId;";

    $selectPathsResult = mysqli_query($conn, $sqlSelectPaths);

    // Go through each row, split resources, grab path info.
    while ($row = mysqli_fetch_assoc($selectPathsResult)) {
            // Split resources.
            $resourceString = $row['resource_list'];
            $resourceArray = explode(',', $resourceString);

            // Path name.
            $givenPathName = $row['path_name'];

            // User name.
            $givenUserName = $row['firstName'];

            // Path description.
            $givenPathDesc = $row['path_desc'];

            // ids (for deletion).
            $givenUserId = $row['user_id'];
            $givenPathId = $row['path_id'];
            $givenResourceId = $row['resource_id'];
    }

    // Likes handling
    $sqlSelectLikes = "SELECT * FROM resource_likes rl
                       JOIN paths p ON p.path_id = rl.path_id
                       WHERE rl.path_id = $pathId;";
    $selectLikesResult = mysqli_query($conn, $sqlSelectLikes);

    // Grab info
    $likes = array();
    $resourceIndex = array();
    while ($row = mysqli_fetch_assoc($selectLikesResult)) {
        array_push($likes, $row['likes']);
        array_push($resourceIndex, $row['resource_index']);
    }
    
    if (isset($givenPathId)) {

    // Page layout.
    echo "
        <div class='pathsGridItems'>
            <h3>$givenPathName</h3>
            <span><p>Created by: $givenUserName </p>
            <p> $givenPathDesc </p></span>
            <h3>Resources</h3>
    ";
        for ($i = 0; $i < count($resourceArray); $i++) {
            // Properly displays likes per resource.
            if ($resourceIndex[$i] == $i) {
                $display = $likes[$i];
            }

            echo "<p>Resource " . ($i + 1) . ": " . $resourceArray[$i] . " Likes ($display)</p>";

            if (isset($_COOKIE['loggedIn'])) {
                echo "
                <form action='../assets/php/like-path.php' method='post' class='userFormOptions'>
                    <input type='text' name='resource$i' value='" . $resourceArray[$i] . "' hidden='true'>
                    <input type='text' name='resourceList' value='" . $resourceString . "' hidden='true'>
                    <input type='text' name='pathId' value='$givenPathId' hidden='true'>
                    <input type='submit' name='$i', value='Like', class='userSubmitOptions'>
                </form>
                ";
            }
        }

        if (isset($_COOKIE['loggedIn'])) {
            echo "                
                <ul class='formList'>
                    <li>
                        <form action='../assets/php/path-form.php' method='post' class='userFormOptions'>
                            <input type='text' name='path_name' value='" . $givenPathName . "' hidden='true'>
                            <input type='text' name='path_desc' value='" . $givenPathDesc . "' hidden='true'>
                            <input type='text' name='resourceList' value='" . $resourceString . "' hidden='true'>
                            <input type='text' name='path_user' value='$givenUserName' hidden='true'>
                            <input type='submit' name='clone' value='Clone' class='userSubmitOptions'>
                        </form>
                    </li>
                    <li>
                        <form action='../assets/php/path-share.php' method='post' class='userFormOptions'>
                            <input type='text' name='pathId' value='" . $givenPathId . "' hidden='true'>
                            <input type='submit' name='share' value='Share' class='userSubmitOptions'>
                        </form>
                    </li>
            ";
        }

        // If user owns the path, display delete / edit options.
        if ($_COOKIE['userId'] == $givenUserId) {
            echo "
            <li>
                <form action='../assets/php/confirm-delete.php' method='post' class='userFormOptions'>
                    <input type='text' name='pathId' value='" . $givenPathId . "' hidden='true'>
                    <input type='text' name='resourceId' value='" . $givenResourceId . "' hidden='true'>
                    <input type='submit' name='delete' value='Delete Path' class='userSubmitOptions'>
                </form>
            </li>
            <li>
                <form action='../assets/php/edit-paths.php' method='post' class='userFormOptions'>
                    <input type='text' name='pathId' value='" . $givenPathId . "' hidden='true'>
                    <input type='text' name='resourceId' value='" . $givenResourceId . "' hidden='true'>
                    <input type='text' name='resourceList' id='resourceList' value='$resourceString' hidden='true'>
                    <input type='submit' name='edit' value='Edit Path' class='userSubmitOptions'>
                </form>
            </li>
            ";
        }
    echo "
        <ul>
    </div>";
    }
}
// Delete path function.
function deletePath($pathId, $resourceId) {
    $dbServerName = "localhost:3306";  // this SHOULD be fine to leave
    $dbUsername = "f3443253"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
    $dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
    $dbName = "f3443253_project"; // this is the name of the database, yours will be f3######_databaseName

        // Connection info.
        $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

        // Sql queries.
        $sqlDeletePath = "DELETE FROM paths WHERE path_id = $pathId;";
        $sqlDeleteResources = "DELETE FROM resources WHERE resource_id = $resourceId;";

        $sqlDeleteLikes = "DELETE FROM resource_likes WHERE path_id = $pathId;";

        mysqli_query($conn, $sqlDeletePath);
        mysqli_query($conn, $sqlDeleteResources);
        mysqli_query($conn, $sqlDeleteLikes);
}
// Get amount of paths to display on learning paths page.
function getPathAmounts() {
    $dbServerName = "localhost:3306";  // this SHOULD be fine to leave
    $dbUsername = "f3443253"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
    $dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
    $dbName = "f3443253_project"; // this is the name of the database, yours will be f3######_databaseName

            $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

            // Sql query.
            $sqlCount = "SELECT COUNT(path_id) as total FROM paths;";
            $result = mysqli_query($conn, $sqlCount);
            $count = mysqli_fetch_assoc($result);
            return $count;
}

// Edit path.
function getExistingValues($pathId) {
    $dbServerName = "localhost:3306";  // this SHOULD be fine to leave
    $dbUsername = "f3443253"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
    $dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
    $dbName = "f3443253_project"; // this is the name of the database, yours will be f3######_databaseName

    // Connection info.
    $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

    // Query to grab pre-existing info.
    $prevInfo = "SELECT * FROM paths p 
                 JOIN resources r ON p.path_id = r.path_id
                 WHERE p.path_id = $pathId";

    $prevResources = "SELECT * FROM paths p 
                      JOIN resources r ON p.path_id = r.path_id
                      WHERE r.resource_id = $pathId";

    // Result for paths query.
    $result = mysqli_query($conn, $prevInfo);
    $resultRows = mysqli_fetch_assoc($result);

    // Result for resources.
    $resourceResult = mysqli_query($conn, $prevResources);
    $resultResources = mysqli_fetch_assoc($resourceResult);

    // Place existing info into variables.
    $resourceArray = explode(',', $resultResources['resource_list']);

    $infoArray = array (
        'existingPathId' => $resultRows['path_id'],
        'existingUserId' => $resultRows['user_id'],
        'existingPathName' => $resultRows['path_name'],
        'existingPathDesc' => $resultRows['path_desc'],
        'existingResourceId' => $resultRows['resource_id'],
        'existingResources' => array (
            $resourceArray
        )
    );
    // Return arrays for use in edit-paths.php.
    return [$infoArray, $pathId];
}

// Shows the edit menu that will redirect to the pathForm page for editing.
function showEditMenu($infoArray, $resourceArray, $pathId, $counter) {
    $resourceList = implode(',', $resourceArray);
    // Echo out the createPath format with the filled pre-existing info.
    echo "
    <link rel='stylesheet' href='../css/style.css'>
    <script src='../js/learning-path.js' defer></script>
    <form method='post' action='path-form.php' id='learning-path-form'>
    <label for='path_name'>Learning Path Name</label>
    <input type='text' id='path_name' name='path_name' value='" . $infoArray['existingPathName'] . "'>

    <label for='path_desc'>Path Description</label>
    <textarea id='path_desc' name='path_desc' cols='30' rows='10'>" . $infoArray['existingPathDesc'] . "</textarea>
    <label for='given_resources' id='given_resources' name='given_resources'>Resources</label>
    ";
        // Loop to output proper amount of resources.
        for ($i = 0; $i < count($resourceArray); $i++)  {
            echo "
                <input type='text' name='given_resources" . ($i + 1) . "' value='" . $resourceArray[$i] . "'>
            ";
        }

    echo "
        <link rel='stylesheet' href='../css/style.css'>
        <div id='append'></div>
        <input type='button' id='add-button' value='Add'>
        <br>
        <input type='text' name='resourceList' id='resourceList' value='$resourceList' hidden='true'>
        <input type='number' name='counter' id='counter' value='$counter' hidden='true'>
        <input type='text' name='edit' id='edit' value='true' hidden='true'>
        <input type='text' name='pathId' value='$pathId' hidden='true'>
        <br>
        <br>
        <input type='submit' value='Edit' class='userSubmitOptions'></input>
    </form>
    ";
}

// Get number of resources in specified path.
function resourceCount($pathId) {
    $dbServerName = "localhost:3306";  // this SHOULD be fine to leave
    $dbUsername = "f3443253"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
    $dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
    $dbName = "f3443253_project"; // this is the name of the database, yours will be f3######_databaseName
    
        // Connection info.
        $conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
    
        // Queries.
        $sqlSelectPaths =  "SELECT * FROM paths p 
                            JOIN resources r 
                            ON p.resource_id = r.resource_id
                            JOIN users u
                            ON u.id = p.user_id
                            WHERE p.path_id = $pathId;";
    
        $selectPathsResult = mysqli_query($conn, $sqlSelectPaths);
    
    
        // Go through each row, split resources, grab path info.
        while ($row = mysqli_fetch_assoc($selectPathsResult)) {    
            // Split resources.
            $resourceString = $row['resource_list'];
            $resourceArray = explode(',', $resourceString);
        }
        return count($resourceArray);
}

// Debugger for jay :)
function debug_to_console($data) {
    $output = $data;
    if (is_array($output)) {
        echo "<pre>"; print_r($output); echo "</pre>";
    } else {
    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
}