<?php 
// Push resources function.
function pushResources($pathUser, $pathName, $pathDescription, $pathResources) {
    // DB info.
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";

    // Ethan's database
    $dbName = "project";
    // Jay's database
    //$dbName = "learning_paths";

    // Connection info.
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    // Separate elements into comma separated list.
    $resourceString = implode(',', $pathResources);

    // Query variables/queries.

    // ******* RESOURCE ID MANAGEMENT ********
    // Grab existing resource IDs.
    $sqlSelectResourceId = "SELECT resource_id FROM resources;";
    $existingResourceIds = mysqli_query($conn, $sqlSelectResourceId);
    
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

    // Insert queries.
    $sqlPathInsert = "INSERT INTO paths (path_id, user_id, path_name, path_desc, resources_id)
                      VALUES ('$newPathId', '$pathUser', '$pathName', '$pathDescription', '$newResourceId');";

    $sqlResourceInsert = "INSERT INTO resources (resource_id, path_id, resource_list)
                          VALUES ('$newPathId', '$newPathId', '$resourceString')";
    
    mysqli_query($conn, $sqlPathInsert);
    mysqli_query($conn, $sqlResourceInsert);
}
// Show resources function.
function showResources($pathId) {
    // DB info.
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";

    // Ethan's database
    $dbName = "project";
    // Jay's database
    //$dbName = "learning_paths";


    // Connection info.
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    // Queries.
    $sqlSelectPaths =  "SELECT * FROM paths p 
                        JOIN resources r 
                        ON p.resources_id = r.resource_id
                        JOIN users u
                        ON u.id = p.user_id
                        WHERE p.path_id = $pathId;";

    $selectPathsResult = mysqli_query($conn, $sqlSelectPaths);


    // Go through each row, split resources, grab path info.
    while ($row = mysqli_fetch_assoc($selectPathsResult)) {
        // echo print_r($row);

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

    // Page layout.
    echo "
        <div class='pathsGridItems'>
            <h3>$givenPathName</h3> <br>
            <span>Created by: $givenUserName <br>
            $givenPathDesc <br></span>
            <h3>Resources</h3> <br>
    ";
        for ($i = 0; $i < count($resourceArray); $i++) {
            echo "<p>" . $resourceArray[$i] .  "</p><br>";
        }
        
        if ($_COOKIE['userId'] == $givenUserId) {
            echo "
            <form action='../assets/php/confirmDelete.php' method='post' class='userFormOptions'>
                <input type='text' name='pathId' value='" . $givenPathId . "' hidden='true'>
                <input type='text' name='resourceId' value='" . $givenResourceId . "' hidden='true'>
                <input type='submit' name='delete' value='Delete Path' class='userSubmitOptions'>
            </form>";

             echo "
            <form action='../assets/php/editPaths.php' method='post' class='userFormOptions'>
                <input type='text' name='pathId' value='" . $givenPathId . "' hidden='true'>
                <input type='text' name='resourceId' value='" . $givenResourceId . "' hidden='true'>
                <input type='submit' name='edit' value='Edit Path' class='userSubmitOptions'>
            </form>
             ";
        }
    echo "</div>";
}
// Delete path function.
function deletePath($pathId, $resourceId) {
        // DB info.
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "project";
        //$dbName = "learning_paths";
        // Connection info.
        $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

        // Sql queries.
        $sqlDeletePath = "DELETE FROM paths WHERE path_id = $pathId;";
        $sqlDeleteResources = "DELETE FROM resources WHERE resource_id = $resourceId;";

        mysqli_query($conn, $sqlDeletePath);
        mysqli_query($conn, $sqlDeleteResources);
}
// Get amount of paths to display on learning paths page.
function getPathAmounts() {
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";

    // Ethan's database
    $dbName = "project";
    // Jay's database
    //$dbName = "learning_paths";

            $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

            // Sql query.
            $sqlCount = "SELECT COUNT(path_id) as total FROM paths;";
            $result = mysqli_query($conn, $sqlCount);
            $count = mysqli_fetch_assoc($result);
            return $count;
}
// Edit path.
function editPath($pathId) {
    // DB info.
    $dbServername = "localhost";
    $dbUsername = "root";
    $dbPassword = "";

    // Ethan's database
    $dbName = "project";
    // Jay's database
    //$dbName = "learning_paths";

    // Connection info.
    $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

    // Query to grab pre-existing info.
    $prevInfo = "SELECT * FROM paths p 
                 JOIN resources r ON p.path_id = r.path_id
                 WHERE p.path_id = $pathId";

    $prevResources = "SELECT * FROM paths p 
                      JOIN resources r ON p.path_id = r.path_id
                      WHERE r.resource_id = $pathId";

    $result = mysqli_query($conn, $prevInfo);
    $resultRows = mysqli_fetch_assoc($result);

    $resourceResult = mysqli_query($conn, $prevResources);
    $resultResources = mysqli_fetch_assoc($resourceResult);

    // Place exisiting info into variables.
    $existingPathId = $resultRows['path_id'];
    $existingUserId = $resultRows['user_id'];
    $existingPathName = $resultRows['path_name'];
    $existingPathDesc = $resultRows['path_desc'];
    $existingResourceId = $resultRows['resources_id'];

    // Resources
    $existingResourceId = $resultResources['resource_id'];
    $existingResources = $resultResources['resource_list'];
    $resourceArray = explode(',', $resultResources['resource_list']);
 
    echo "
        <link rel='stylesheet' href='../css/style.css'>
        <script src='../js/learning-path.js' defer></script>
        <form method='post' action='' id='learning-path-form'>
        <label for='path_name'>Learning Path Name</label>
        <input type='text' id='path_name' name='path_name' value='$existingPathName'>

        <label for='path_desc'>Path Description</label>
        <textarea id='path_desc' name='path_desc' cols='30' rows='10' value='$existingPathDesc'></textarea>
        <label for='given_resources' id='given_resources' name='given_resources'>Resources</label>
        ";

    for ($i = 0; $i < count($resourceArray); $i++) {
        echo "
            <input type='text' name='given_resources" . $i + 1 . "' value='$resourceArray[$i]'>
        ";
    }

    echo "
        <div id='append'></div>
        <input type='button' id='add-button' value='Add'>
        <br>
        <input type='number' name='counter' id='counter' readonly='true' hidden='true'>
        <br>
        <br>
        <a href='learningPaths.php'><input type='submit'></a>
    </form>
    ";
}