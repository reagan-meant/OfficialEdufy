<?php
include_once 'db_connection.php';

//if (!empty($_POST)){

if ($_POST['question_text'] and $_POST['class_id'] and $_POST['term_id'] and $_POST['correct_option'] and $_POST['subject_id'] and $_POST['option1']) {
  $questionText = $_POST['question_text'];
  $natureOfQn =  $_POST['nature'];
  $ClassId = $_POST['class_id'];
  $termId = $_POST['term_id'];
  $correctOption = $_POST['correct_option'];
  $paperNumber = $_POST['paper_number'];
  $subjectId = $_POST['subject_id'];
  $option1 = $_POST['option1'];
  $option2 = $_POST['option2'];
  $option3 = $_POST['option3'];
  $option4 = $_POST['option4'];
  $images = 0;

  /*     $file= $_FILES['questionImage'];
    $answerfile= $_FILES['answerImage'];



    $file_name = $file["name"];
    $file_type = $file["type"];
    $temp_name = $file["tmp_name"];
    $file_size = $file["size"];
    $error = $file["error"];

    $answerfile_name = $answerfile["name"];
    $answerfile_type = $answerfile["type"];
    $answerfileTemp_name = $answerfile["tmp_name"];
    $answerfile_size = $answerfile["size"];
    $answerfileError = $answerfile["error"]; */
  /*  if (!$temp_name)
    {
        echo "ERROR: Please browse for file before uploading";
        exit();
    } */

  // Count # of uploaded files in array
  $total = count($_FILES['questionImages']['name']);

  // Count # of uploaded files in array
  $answerTotal = count($_FILES['answerImages']['name']);

  if (($total > 0) || ($answerTotal > 0)) {
    $images = 1;
  }

  $answerId = insertAnswers($option1, $option2, $option3, $option4);
  echo $answerId;
  $questionId = insertQuestion($questionText, $natureOfQn, $images, $ClassId, $termId, $correctOption, $answerId, $subjectId, $paperNumber);

  // Loop through each file
  for ($i = 0; $i < $total; $i++) {

    //Get the temp file path
    $tmpFilePath = $_FILES['questionImages']['tmp_name'][$i];
    $file_type =  $_FILES['questionImages']['type'][$i];
    $newFilePath = '../resources/images/questions/' . 'qn' . $questionId . '.' . $i . '.jpg';

    //Make sure we have a file path
    if ($tmpFilePath != "") {
      //Setup our new file path

      if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg")) {
        $filename = compress_image($tmpFilePath, $newFilePath, 20);
      } else {
        echo "Uploaded image should be jpg or gif or png.";
      }

      /* //Upload the file into the temp dir
      if (move_uploaded_file($tmpFilePath, $newFilePath)) {

        //Handle other code here

      } */
    }
  }



  // Loop through each file
  for ($i = 0; $i < $answerTotal; $i++) {

    //Get the temp file path
    $tmpFilePath = $_FILES['answerImages']['tmp_name'][$i];
    $file_type =  $_FILES['answerImages']['type'][$i];
    $newFilePath = '../resources/images/answers/' . 'qn' . $answerId . '.' . $i . '.jpg';

    //Make sure we have a file path
    if ($tmpFilePath != "") {
      //Setup our new file path

      if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg")) {
        $filename = compress_image($tmpFilePath, $newFilePath, 20);
      } else {
        echo "Uploaded image should be jpg or gif or png.";
      }
    }
  }

  /* $fileDestination = '../resources/images/questions/'.'qn'.$questionId.'.jpg';
    $answerfileDestination = '../resources/images/answers/'.'ans'.$answerId.'.jpg';

    
    if ($error > 0)
    {
        echo $error;
    }
    else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
    {
        $filename = compress_image($temp_name, $fileDestination, 10);
    }
    else
    {
        echo "Uploaded image should be jpg or gif or png.";
    }
    
    if ($answerfileError > 0)
    {
        echo $error;
    }
    else if (($answerfile_type == "image/gif") || ($answerfile_type == "image/jpeg") || ($answerfile_type == "image/png") || ($answerfile_type == "image/pjpeg"))
    {
        $filename = compress_image($answerfileTemp_name, $answerfileDestination, 10);
    }
    else
    {
        echo "Uploaded image should be jpg or gif or png.";
    } */
  /*     move_uploaded_file($fileTmpName,$fileDestination);
 */
  header("Location:http://localhost/officialedufy/app/forms/QA.php");
} else {
  echo "Insert all fields";
}

function insertAnswers($option1, $option2, $option3, $option4)
{
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO answers(option1,option2,option3,option4) VALUES (?,?,?,?)");
  $query->bind_param("ssss", $option1, $option2, $option3, $option4);


  if ($query->execute()) {
    $ID = $query->insert_id;
    CloseCon($conn);
    return $ID;
  } else {
    return $conn->error;
  }
}


function insertQuestion($questionText, $natureOfQn, $images, $ClassId, $termId, $correctOption, $answerId, $subjectId, $paperNumber)
{
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO questions(question_text,tag,images,class_id,term_id,correct_option,answer_id,subject_id,paper_number) VALUES (?,?,?,?,?,?,?,?,?)");
  $query->bind_param("sssiiiiii", $questionText, $natureOfQn, $images, $ClassId, $termId, $correctOption, $answerId, $subjectId, $paperNumber);


  if ($query->execute()) {
    $ID = $query->insert_id;
    CloseCon($conn);
    return $ID;
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
    return $conn->error;
  }
}

function compress_image($source_url, $destination_url, $quality)
{
  $info = getimagesize($source_url);
  if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
  elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
  elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
  imagejpeg($image, $destination_url, $quality);
  echo "Image uploaded successfully.";
}

/* 
//$files = array_filter($_FILES['upload']['name']); //something like that to be used before processing files.

// Count # of uploaded files in array
$total = count($_FILES['upload']['name']);

// Loop through each file
for ($i = 0; $i < $total; $i++) {

  //Get the temp file path
  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];

  //Make sure we have a file path
  if ($tmpFilePath != "") {
    //Setup our new file path
    $newFilePath = "./uploadFiles/" . $_FILES['upload']['name'][$i];

    //Upload the file into the temp dir
    if (move_uploaded_file($tmpFilePath, $newFilePath)) {

      //Handle other code here

    }
  }
} */