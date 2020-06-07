<?php



function sqUserTerms($studentUsername){
//$conn = OpenCustomCon($username);
$csvFile = fopen('C:\xampp1\htdocs\edufy\app\resources\files\terms.csv', 'r');

//$csvFile = fopen('../../resources/files/terms.csv', 'r');
            
// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    // Get row data
    

    $termId   = $line[0];
    $termName  = $line[1];
    $classId  = $line[2];
    
    // Check whether member already exists in the database with the same email
    $prevQuery = "SELECT COUNT(*) as count FROM terms WHERE term_id = '".$line[0]."'";

    $db = new MyDB($studentUsername);
    if (!$db) {
        echo $db->lastErrorMsg();
    } else {
        $prevResult = $db->query($prevQuery);

        $row = $prevResult->fetchArray();
        $numRows = $row['count'];
        //$prevResult = $conn->query($prevQuery);

        if ($numRows > 0) {
        // Update member data in the database
       // $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
    }else{
        // Insert member data in the database
        $db->query("INSERT INTO terms (term_id,term_name,class_id) VALUES ('".$termId."', '".$termName."', '".$classId."')");
    }
    $db->close();
        }
}

// Close opened CSV file
fclose($csvFile);
}
?>