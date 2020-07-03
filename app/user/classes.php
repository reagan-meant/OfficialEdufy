<?php

function userClasses($username){
$conn = OpenCustomCon($username);
$csvFile = fopen('../resources/files/classes.csv', 'r');
            
// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    // Get row data
    $classId   = $line[0];
    $className  = $line[1];
    $levelId = $line[2];
    
    // Check whether member already exists in the database with the same email
    $prevQuery = "SELECT class_id FROM classes WHERE class_id = '".$line[0]."'";
    $prevResult = $conn->query($prevQuery);
    
    if($prevResult->num_rows > 0){
        // Update member data in the database
       // $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
    }else{
        // Insert member data in the database
        $conn->query("INSERT INTO classes (class_id, class_name,  level_id) VALUES ('" . $classId . "', '" . $className . "', '" . $levelId . "')");
    }
}


// Close opened CSV file
fclose($csvFile);
CloseCon($conn);
}
?>