<?php

//include_once '../dao/tables.php';

function userQuestions($username){
$conn = OpenCustomCon($username);
$csvFile = fopen('../resources/files/questions.csv', 'r');
            
// Skip the first line
fgetcsv($csvFile);

// Parse data from CSV file line by line
while(($line = fgetcsv($csvFile)) !== FALSE){
    // Get row data
   // question_id,question_text,tag,class_id,term_id,correct_option,answer_id,subject_id

    $questionId   = $line[0];
    $questionText  = $line[1];
    $tag  = $line[2];
    $paperNumber =  $line[3];
    $classId  = $line[4];
    $termId  = $line[5];
    $correctOption  = $line[6];
    $answerId  = $line[7];
    $subjectId  = $line[8];
    
    // Check whether member already exists in the database with the same email
    $prevQuery = "SELECT question_id FROM questions WHERE question_id = '".$line[0]."'";
    $prevResult = $conn->query($prevQuery);
    
    if($prevResult->num_rows > 0){
        // Update member data in the database
       // $db->query("UPDATE members SET name = '".$name."', phone = '".$phone."', status = '".$status."', modified = NOW() WHERE email = '".$email."'");
    }else{
        // Insert member data in the database
        $conn->query("INSERT INTO questions (question_id,question_text,tag,paper_number,class_id,term_id,correct_option,answer_id,subject_id
        ) VALUES ('".$questionId."', '".$questionText."', '".$tag."','".$paperNumber."', '".$classId."', '".$termId."', '".$correctOption."', '".$answerId."', '".$subjectId."')");
    }
}


// Close opened CSV file
fclose($csvFile);
CloseCon($conn);
}
?>