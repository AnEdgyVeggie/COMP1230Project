<?php

        $dbServerName = "localhost";
        $dbUsername = "root";
        $dbPassword = ""; 
        $dbName = "project";


    $connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
    
    // for testing
    // var_dump($connection);
    // echo'<br>';
    // echo mysqli_connect_error();


?>