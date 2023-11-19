<?php
echo htmlspecialchars($_SERVER['PHP_SELF']);
include "learning-path.php";

// If user submits form...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If name, desc, and resources are set...
    if (isset($_POST['path-name']) && isset($_COOKIE['firstName']) && isset($_POST['path-desc']) && isset($_POST['given-resources1'])) {

        // TODO
        // Set variables to global.
        global $pathName;
        global $pathUser;
        global $pathDescription;
        global $pathResources;
        // Pull values from form.
        $pathName = $_POST['path-name'];
        $pathUser = $_COOKIE['firstName'];
        $pathDescription = $_POST['path-desc'];
        $pathResources = array();
        // Pull from counter to push array.
        if (isset($_POST['counter'])) {
            $counter = $_POST['counter'];
            for ($i = 1; $i < $counter; $i++) {
                // For as many resources as there are, push each resource to an array.
                array_push($pathResources, $_POST['given-resources' . $i]);
            }
        }
    }

    // Put these variables into a LearningPath object if they are set.
    $path = new LearningPath($pathName, $pathUser, $pathDescription, $pathResources);

    //echo "<pre>"; print_r($path); "<pre>";



    // Append this variable into a learning path storage file.
    //file_put_contents("LearningPaths.txt", var_export($path, true), FILE_APPEND);

    function showResources($pathUser, $pathName, $pathDescription, $pathResources) {
        $dbServername = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "learning-path";
    
        $conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

        $resourceString = implode(',', $pathResources);

        $sqlInsert1 = "INSERT INTO paths (user, path_name, path_desc, resource_id) 
                      VALUES ('$pathUser', '$pathName', '$pathDescription', 19);";
        $sqlInsert2 = "INSERT INTO resources (resources) VALUES ('$resourceString');";

        mysqli_query($conn, $sqlInsert1);
        mysqli_query($conn, $sqlInsert2);
    
        $sqlSelect = "SELECT * FROM paths JOIN resources ON paths.resource_id = resources.resource_id;";
        $selectResult = mysqli_query($conn, $sqlSelect);
    
        while ($row = mysqli_fetch_assoc($selectResult)) {
            $string = $row['resources'];
            $resourceArray = explode(',', $string);
        }
    
        echo "<pre>"; print_r($resourceArray); echo "<pre>";
    }
    
    showResources($pathUser, $pathName, $pathDescription, $pathResources);
}
?>


