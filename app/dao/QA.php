<?php
include_once 'db_connection.php';

//if (!empty($_POST)){

  if($_POST['question_text'] and $_POST['class_id'] and $_POST['term_id'] and $_POST['correct_option'] and $_POST['subject_id'] and $_POST['option1'] and $_POST['option2'] and $_POST['option3'] and $_POST['option4']){
    $questionText = $_POST['question_text'];
    $ClassId = $_POST['class_id'];
    $termId = $_POST['term_id'];
    $correctOption = $_POST['correct_option'];
    $paperNumber = $_POST['paper_number'];
    $subjectId = $_POST['subject_id'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];

    echo $option1;
    echo $option2;
    echo $option3;
    echo $option4;
    $answerId = insertAnswers($option1,$option2,$option3,$option4);
    echo $answerId;
    insertQuestion($questionText,$ClassId,$termId,$correctOption,$answerId,$subjectId,$paperNumber);
    header("Location:http://localhost/edufy/app/forms/QA.php");
} else{
    echo "Insert all fields";
}

function insertAnswers($option1,$option2,$option3,$option4)
{
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO answers(option1,option2,option3,option4) VALUES (?,?,?,?)");
  $query->bind_param("ssss", $option1,$option2,$option3,$option4);


  if ($query->execute()) {
    $ID=$query->insert_id;
    CloseCon($conn);
    return $ID;
  } else {
    return $conn->error;
  }
}


function insertQuestion($questionText,$ClassId,$termId,$correctOption,$answerId,$subjectId,$paperNumber)
{
  $natureOfQn = "objective";
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO questions(question_text,tag,class_id,term_id,correct_option,answer_id,subject_id,paper_number) VALUES (?,?,?,?,?,?,?,?)");
  $query->bind_param("ssiiiiii", $questionText,$natureOfQn,$ClassId,$termId,$correctOption,$answerId,$subjectId,$paperNumber);


  if ($query->execute()) {
    CloseCon($conn);
    return true;
  } else {
    return $conn->error;
  }
}

function getQuestions()
{
  $conn = OpenCon();
  $result = $conn->query("SELECT * FROM questions");
  if ($result) {
    if ($result->num_rows > 0) {
      return $result;
    } else {
      return "zero";
    }
  } else {
    return $result->error;
  }
}
?>

