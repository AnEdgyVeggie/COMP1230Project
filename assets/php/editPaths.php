<?php 
ini_set('display_errors', 1);
include('pathFunctions.php');

if (isset($_POST['edit'])) {
    $pathId = $_POST['pathId'];
    $resourceArray = resourceCount($pathId);
    showEditMenu(getExistingValues($pathId)[0], getExistingValues($pathId)[1], $pathId, count($resourceArray));
}