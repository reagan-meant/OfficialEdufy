<?php
include_once 'db_connection.php';

if (!empty($_POST)){
$subjectName = $_POST['subject_name'];
$classId = $_POST['class_id'];

insertSubject($subjectName,$classId);
header("Location:http://localhost/officialedufy/app/forms/subjects.php");
}
function insertSubject($subjectName,$classId)
{
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO subjects(subject_name,class_id) VALUES (?,?)");
  $query->bind_param("si", $subjectName,$classId);

  if ($query->execute()) {
    CloseCon($conn);
    return true;
  } else {
    return $conn->error;
  }
}

function selectSubjects()
{
  $conn = OpenCon();
  $result = $conn->query("SELECT * FROM subjects");
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

