<?php

include_once '../dao/tables.php';

function userSubjects($username){
$conn = OpenCustomCon($username);
$csvFile = fopen('../resources/files/subjects.csv', 'r');
            
// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    // Get row data
    

    $subjectId   = $line[0];
    $subjectName  = $line[1];
    $classId  = $line[2];
    
    // Check whether member already exists in the database with the same email
    $prevQuery = "SELECT id FROM subjects WHERE class_id = '".$line[0]."'";
    $prevResult = $conn->query($prevQuery);
    
    if($prevResult->num_rows > 0){
        // Update member data in the database
       // $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
    }else{
        // Insert member data in the database
        $conn->query("INSERT INTO subjects (subject_id,subject_name,class_id) VALUES ('".$subjectId."', '".$subjectName."', '".$classId."')");
    }
}

// Close opened CSV file
fclose($csvFile);
CloseCon($conn);
}
?>