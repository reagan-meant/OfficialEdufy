<?php
include_once 'app/dao/tables.php';


$conn = OpenCon();
$testit = createDB("Makoba",$conn);

function createDB($studentUsername,$conn){
    //$conn = OpenCon();
    $sql = "CREATE DATABASE ".$studentUsername;
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully with the name newDB";
        $conn1 = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

        $createMissingTables=createTables();
    } else {
        echo "Error creating database: " . $conn->error;
    }
    
    // closing connection
    $conn->close();
}
?>
