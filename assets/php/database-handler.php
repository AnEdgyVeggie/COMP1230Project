<?php

        $dbServerName = "localhost:3306";  // this SHOULD be fine to leave
        $dbUsername = "f3479568"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
        $dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
        $dbName = "f3479568_project"; // this is the name of the database, yours will be f3######_databaseName


    $connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
    
    // for testing
    // var_dump($connection);
    // echo'<br>';
    // echo mysqli_connect_error();


?>