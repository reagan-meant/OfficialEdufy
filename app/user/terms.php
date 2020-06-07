<?php

function userTerms($username){
$conn = OpenCustomCon($username);
$csvFile = fopen('../resources/files/terms.csv', 'r');
            
// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    // Get row data
    

    $termId   = $line[0];
    $termName  = $line[1];
    $classId  = $line[2];
    
    // Check whether member already exists in the database with the same email
    $prevQuery = "SELECT term_id FROM terms WHERE term_id = '".$line[0]."'";
    $prevResult = $conn->query($prevQuery);
    
    if($prevResult->num_rows > 0){
        // Update member data in the database
       // $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
    }else{
        // Insert member data in the database
        $conn->query("INSERT INTO subjects (term_id,term_name,class_id) VALUES ('".$termId."', '".$termName."', '".$classId."')");
    }
}

// Close opened CSV file
fclose($csvFile);
CloseCon($conn);
}
?>