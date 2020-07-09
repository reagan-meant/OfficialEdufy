<?php


function sqUserQuestions($studentUsername){

    $csvFile = fopen('C:\xampp\htdocs\officialedufy\app\resources\files\questions.csv', 'r');

//$csvFile = fopen('../../resources/files/questions.csv', 'r');
            
// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    // Get row data
   // question_id,question_text,tag,class_id,term_id,correct_option,answer_id,subject_id
    
    $questionId   = $line[0];
    $questionText  = $line[1];
    $tag  = $line[2];
    $images  = $line[3];
    $paperNumber =  $line[4];
    $classId  = $line[5];
    $termId  = $line[6];
    $correctOption  = $line[7];
    $answerId  = $line[8];
    $subjectId  = $line[9];
    // Check whether member already exists in the database with the same email
    $prevQuery = "SELECT COUNT(*) as count FROM questions WHERE question_id = '".$line[0]."'";

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
        $db->query("INSERT INTO questions (question_id,question_text,tag,images,paper_number,class_id,term_id,correct_option,answer_id,subject_id
        ) VALUES ('".$questionId."', '".$questionText."', '".$tag."', '".$images."','".$paperNumber."', '".$classId."', '".$termId."', '".$correctOption."', '".$answerId."', '".$subjectId."')");
    }
    $db->close();
        }
}

// Close opened CSV file
fclose($csvFile);
}
?>