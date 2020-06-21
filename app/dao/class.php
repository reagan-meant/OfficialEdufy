<?php
include_once 'db_connection.php';

if (!empty($_POST)){
$className = $_POST['class_name'];
$levelId = $_POST['level_id'];
insertClasses($className,$levelId);
header("Location:http://localhost/officialedufy/app/forms/class.php");
}
function insertClasses($className,$levelId)
{
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO classes(class_name,level_id) VALUES (?,?)");
  $query->bind_param("si", $className,$levelId);

  if ($query->execute()) {
    CloseCon($conn);
    return true;
  } else {
    return $conn->error;
  }
}

function selectClasses()
{
  $conn = OpenCon();
  $result = $conn->query("SELECT * FROM classes");
  if ($result) {
    if ($result->num_rows > 0) {
      CloseCon($conn);
      return $result;
    } else {
      CloseCon($conn);
      return "zero";
    }
  } else {
    return $result->error;
  }
}
?>

