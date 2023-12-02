<?php
<<<<<<< HEAD
        $dbServerName = "localhost:3306";  // this SHOULD be fine to leave
        $dbUsername = "f3479568"; // this will be f3######       REMOVE THESE COMMENTS, FOR SOME REASON COMMENTS WERE CAUSING ERRORS
        $dbPassword = "PASSWORD"; // this is the password YOU USE TO LOG INTO gblearn
        $dbName = "f3479568_project"; // this is the name of the database, yours will be f3######_databaseName


    $connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
    
    // for testing
    // var_dump($connection);
    // echo'<br>';
    // echo mysqli_connect_error();

=======
    $dbServerName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "project";


    // // GBLEARN CPANEL
    // $dbServerName = "localhost";
    // $dbUsername = " f3479568";
    // $dbPassword = "CSESmmcc4!!";
    // $dbName = "f3479568_project";


    $connection = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
>>>>>>> 03e4bac4afc9ec165bfaabc3592b9d1c8d876dad
?>