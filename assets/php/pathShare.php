<?php
include('pathFunctions.php');
$pathId = $_POST['pathId'];
echo "<link rel='stylesheet' href='../../assets/css/style.css'>";
showResources($pathId);

echo "
    <form action='../../pages/learningPaths.php' method='post'>
        <label for='return'>Return to Learning Paths?</label>
        <input type='submit' value='Return to Learning Paths'>
    </form>
";
