<?php
echo htmlspecialchars($_SERVER['PHP_SELF']);
include "learning-path.php";

// If user submits form...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If name, desc, and resources are set...
    if (isset($_POST['path-name']) && isset($_COOKIE['firstName']) && isset($_POST['path-desc']) && isset($_POST['given-resources1'])) {

        // TODO
        // Resource validation.
        // Regex variable.
        

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

    // Append this variable into a learning path storage file.
    file_put_contents("LearningPaths.txt", var_export($path, true), FILE_APPEND);
}

?>


