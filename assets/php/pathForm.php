<?php
include('pathFunctions.php');
// Protects page from unwanted HTML code injections.
htmlspecialchars($_SERVER['PHP_SELF']);
echo "<link rel='stylesheet' href='../css/style.css'>";
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

        if ($_POST['edit'] == "true") {
            // Pull values from the edit form.
            $pathId = $_POST['pathId'];
            $pathName = $_POST['path_name'];
            $pathUser = $_COOKIE['userId'];
            $pathDescription = $_POST['path_desc'];
            $pathResources = array();

            $counter = $_POST['counter'];
            for ($i = 1; $i < $counter; $i++) {
                // For as many resources as there are, push each resource to an array.
                array_push($pathResources, $_POST['given_resources' . $i]);
            }
            // Function to place resources in DB.
            pushResources(true, $pathUser, $pathName, $pathDescription, $pathResources, $pathId, $counter);
        } else {
        // Function to place resources in DB.
            pushResources(false, $pathUser, $pathName, $pathDescription, $pathResources, 1, $counter);
        }


        header('Location: ../../pages/learningPaths.php');
    } else {
        echo "Something went wrong!";
    }
}