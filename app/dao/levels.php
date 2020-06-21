<?php
include_once 'db_connection.php';

if (!empty($_POST)){
$levelName = $_POST['level_name'];

insertLevels($levelName);
header("Location:http://localhost/officialedufy/app/forms/level.php");
}
function insertLevels($levelName)
{
  $conn = OpenCon();
  $query = $conn->prepare("INSERT INTO Levels(level_name) VALUES (?)");
  $query->bind_param("s", $levelName);

  if ($query->execute()) {
    CloseCon($conn);
    return true;
  } else {
    return $conn->error;
  }
}

function selectLevels()
{
  $conn = OpenCon();
  $result = $conn->query("SELECT * FROM Levels");
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

