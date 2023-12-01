<?php
// Grab path id and resource id from previous page to transfer into the delete function.
$confirmPathId = $_POST['pathId'];
$confirmResourceId = $_POST['resourceId'];

// Confirm password for extra safety measure against maliciously deleting paths.
echo "
    <link rel='stylesheet' href='../css/style.css'>
    <form action='delete-paths.php' method='post'>
        <label for='confirmPassword'>Enter your password:</label>
        <input type='password' name='confirmPassword'>
        <input type='text' name='pathId' hidden='true' value='$confirmPathId'>
        <input type='text' name='resourceId' hidden='true' value='$confirmResourceId'>
        <input type='submit' name='confirmDeleteSubmit' value='Submit' id='confirmDeleteSubmit'>
    </form>
";