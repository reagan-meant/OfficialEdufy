<?php
include_once 'db_connection.php';

if (!empty($_POST)){
$className = $_POST['class_name'];

insertClasses($className);
header("Location:http://localhost/edufy/app/forms/class.php");
}
function insertClasses($className)
{
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO classes(class_name) VALUES (?)");
  $query->bind_param("s", $className);

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

