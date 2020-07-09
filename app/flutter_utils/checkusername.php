<?php
include_once '../dao/student.php';

$studentUsername = $_GET['username'];
$studentPassword = $_GET['password'];
$present = checkStudentbyUsernameAndPassword($studentUsername,$studentPassword);
$userPresent = checkStudentbyUsername($studentUsername);
  if ($present === "present"){
    header("Content-type:application/json");
    $present = array('present' => 'true');
    echo json_encode($present);
    //echo $present;
} else if ($userPresent === "present"){
  header("Content-type:application/json");
  $present = array('present' => 'userpresent');
  echo json_encode($present);
   // echo "userpresent";
} else{
  header("Content-type:application/json");
  $present = array('present' => 'absent');
  echo json_encode($present);} 


?>