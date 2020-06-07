<?php

function sqUserLevels($studentUsername)
{
    //$conn = OpenCustomCon($username);
   
    $csvFile = fopen('C:\xampp1\htdocs\edufy\app\resources\files\levels.csv', 'r');

    //$csvFile = fopen('../../resources/files/classes.csv', 'r');

    // Skip the first line
    fgetcsv($csvFile);

    // Parse data from CSV file line by line
    while (($line = fgetcsv($csvFile)) !== FALSE) {
        // Get row data
        $levelId   = $line[0];
        $levelName  = $line[1];

        // Check whether member already exists in the database with the same email
        $prevQuery = "SELECT COUNT(*) as count FROM levels WHERE level_id = '" . $line[0] . "'";

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
                $db->query("INSERT INTO levels (level_id, level_name) VALUES ('" . $levelId . "', '" . $levelName . "')");
            }
            $db->close();
        }
    }

    // Close opened CSV file
    fclose($csvFile);
}
