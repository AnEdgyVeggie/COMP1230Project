<?php
include('pathFunctions.php');
include('databaseHandler.php');

$pathId = $_POST['pathId'];
$resourceId = $_POST['resourceId'];

deletePath($pathId, $resourceId);
header("Location: ../../pages/learningPaths.php");












