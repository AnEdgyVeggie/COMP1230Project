<?php

        $dbServerName = "localhost:3306";
        $dbUsername = "f3443253";
        $dbPassword = "PASSWORD"; 
        $dbName = "f3443253_project";


    $connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
    
    // for testing
    // var_dump($connection);
    // echo'<br>';
    // echo mysqli_connect_error();


?>