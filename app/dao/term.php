<?php
include_once 'db_connection.php';

if (!empty($_POST)){
$termName = $_POST['term_name'];
$classId = $_POST['class_id'];

insertTerm($termName,$classId);
header("Location:http://localhost/edufy/app/forms/terms.php");
}
function insertTerm($termName,$classId)
{
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO terms(term_name,class_id) VALUES (?,?)");
  $query->bind_param("si", $termName,$classId);

  if ($query->execute()) {
    CloseCon($conn);
    return true;
  } else {
    return $conn->error;
  }
}

function selectTerms()
{
  $conn = OpenCon();
  $result = $conn->query("SELECT * FROM terms");
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

