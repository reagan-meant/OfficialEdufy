<?php

function userLevels($username){
$conn = OpenCustomCon($username);
$csvFile = fopen('../resources/files/levels.csv', 'r');
            
// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    // Get row data
    $levelId   = $line[0];
    $levelName  = $line[1];
    
    // Check whether member already exists in the database with the same email
    $prevQuery = "SELECT level_id FROM levels WHERE level_id = '".$line[0]."'";
    $prevResult = $conn->query($prevQuery);
    
    if($prevResult->num_rows > 0){
        // Update member data in the database
       // $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
    }else{
        // Insert member data in the database
        $conn->query("INSERT INTO levels (level_id, level_name) VALUES ('".$levelId."', '".$levelName."')");
    }
}

// Close opened CSV file
fclose($csvFile);
CloseCon($conn);
}
?>