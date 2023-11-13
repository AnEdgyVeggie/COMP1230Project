<?php
include "learning-path.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['path-name']) && isset($_POST['path-desc']) && isset($_POST['given-resources1'])) {
        $pathName = $_POST['path-name'];
        $pathDescription = $_POST['path-desc'];
        $pathResources = array();

        if (isset($_POST['counter'])) {
            $counter = $_POST['counter'];
            for ($i = 1; $i < $counter; $i++) {
                array_push($pathResources, $_POST['given-resources' . $i]);
            }
        }
    }


}



    $test = new LearningPath($pathName, "Jay", $pathDescription, $pathResources);
    echo "<pre>"; print_r($test); echo "<pre>";

?>

<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>
