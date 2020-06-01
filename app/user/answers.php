<?php

include_once '../dao/tables.php';

function userAnswers($username){
$conn = OpenCustomCon($username);
$csvFile = fopen('../resources/files/answers.csv', 'r');
            
// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    // Get row data
    $answerId   = $line[0];
    $option1  = $line[1];
    $option2  = $line[2];
    $option3  = $line[3];
    $option4  = $line[4];
    
    // Check whether member already exists in the database with the same email
    $prevQuery = "SELECT id FROM answers WHERE answer_id = '".$line[0]."'";
    $prevResult = $conn->query($prevQuery);
    
    if($prevResult->num_rows > 0){
        // Update member data in the database
       // $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
    }else{
        // Insert member data in the database
        $conn->query("INSERT INTO answers (answer_id,option1,option2,option3,option4) VALUES ('".$answerId."', '".$option1."', '".$option2."', '".$option3."', '".$option4."')");
    }
}

// Close opened CSV file
fclose($csvFile);
CloseCon($conn);
}
?>