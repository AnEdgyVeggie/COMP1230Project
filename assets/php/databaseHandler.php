<?php
    // LOCAL DATABASE
    $dbServerName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "project";


    // GBLEARN CPANEL
    // $dbServerName = "localhost:3306";
    // $dbUsername = "f3479568_f3479568";
    // $dbPassword = "CSESmmcc4!!";
    // $dbName = "f3479568_project";

    $connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);

?>