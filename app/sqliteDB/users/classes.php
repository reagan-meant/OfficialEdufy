<?php

function sqUserClasses($studentUsername)
{
    //$conn = OpenCustomCon($username);
   
    $csvFile = fopen('C:\xampp\htdocs\officialedufy\app\resources\files\classes.csv', 'r');

    //$csvFile = fopen('../../resources/files/classes.csv', 'r');

    // Skip the first line
    fgetcsv($csvFile);

    // Parse data from CSV file line by line
    while (($line = fgetcsv($csvFile)) !== FALSE) {
        // Get row data
        $classId   = $line[0];
        $className  = $line[1];
        $levelId = $line[2];

        // Check whether member already exists in the database with the same email
        $prevQuery = "SELECT COUNT(*) as count FROM classes WHERE class_id = '" . $line[0] . "'";

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
            } else {
                // Insert member data in the database
                $db->query("INSERT INTO classes (class_id, class_name, level_id) VALUES ('" . $classId . "', '" . $className . "', '" . $levelId . "')");
            }
            $db->close();
        }
    }

    // Close opened CSV file
    fclose($csvFile);
}
