<?php
include('path-functions.php');
// Protects page from unwanted HTML code injections.
htmlspecialchars($_SERVER['PHP_SELF']);

// Set variables to global.
global $pathName, $pathUser, $pathDescription, $pathResources;

// If the user submits the form...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If the name, user, desc, resources are set...
    if (isset($_POST['path_name']) && isset($_COOKIE['userId']) && isset($_POST['path_desc']) && isset($_POST['given_resources1'])) {
        // Pull values from the form.
        $pathName = $_POST['path_name'];
        $pathUser = $_COOKIE['userId'];
        $pathDescription = $_POST['path_desc'];
        $pathResources = array();
        

        // Pull from counter element to push the array.
        if (isset($_POST['counter'])) {
            $counter = $_POST['counter'];
            for ($i = 1; $i < $counter; $i++) {
                // For as many resources as there are, push each resource to an array.
                array_push($pathResources, $_POST['given_resources' . $i]);
            }
        }

        // If this is an edit to an existing post...
        if ($_POST['edit'] == "true") {
            // Pull values from the edit form.
            $existingPathId = $_POST['pathId'];
            $pathName = $_POST['path_name'];
            $pathUser = $_COOKIE['userId'];
            $pathDescription = $_POST['path_desc'];
            $resourceList = $_POST['resourceList'];
            $pathResources = explode(',', $resourceList);
            $newResources = array();

            $existingCount = count(getExistingValues($existingPathId)[0]['existingResources'][0]);
            $newCount = $_POST['counter'];

            for ($i = ($existingCount + 1); $i < $newCount; $i++) {
                array_push($newResources, $_POST['given_resources' . $i]);
            }
            // Merge the two arrays.
            $pathResources = array_merge($pathResources, $newResources);
            
            // Function to place resources in DB.
            pushResources(true, $pathUser, $pathName, $pathDescription, $pathResources, $existingPathId);
        } else { // If this is a new post...
        // Function to place resources in DB.
            pushResources(false, $pathUser, $pathName, $pathDescription, $pathResources, 1);
        }

        // Relocate page.
        header('Location: ../../pages/learning-paths.php');
    } else if ($_POST['clone'] == 'Clone') {
        $pathName = $_POST['path_name'];
        $pathUser = $_COOKIE['userId'];
        $pathDescription = $_POST['path_desc'];
        $resourceList = $_POST['resourceList'];

        $resourceArray = explode(',', $resourceList);

        pushResources(false, $pathUser, $pathName, $pathDescription, $resourceArray);
        header('Location: ../../pages/learning-paths.php');
    }

}
echo "<link rel='stylesheet' href='../css/style.css'>";