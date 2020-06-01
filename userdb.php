<?php
include_once 'app/dao/tables.php';


$conn = OpenConFree();
$testit = createDB("Makoba", $conn);

function createDB($studentUsername, $conn)
{
    $sql = "CREATE DATABASE " . $studentUsername . " DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
    if (empty(mysqli_fetch_array(mysqli_query($conn, "SHOW DATABASES LIKE '$studentUsername'")))) {

        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully with the name " . $studentUsername;

            //creating user Tables
            createUserTables($studentUsername);
        } else {

            echo "Error creating database: " . $conn->error;
        }
    }
    // closing connection
    CloseCon($conn);
}
