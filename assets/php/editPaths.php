<?php 
ini_set('display_errors', 1);
include('pathFunctions.php');

if (isset($_POST['edit'])) {
    $pathId = $_POST['pathId'];

    showEditMenu(getExistingValues($pathId)[0], getExistingValues($pathId)[0]['existingResources'][0], $pathId, (resourceCount($pathId) + 1));
}