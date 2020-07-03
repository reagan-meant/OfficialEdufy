<?php
include_once '../dao/student.php';
include_once '../sqliteDB/users/generate_userDB.php';


if(!empty($_POST) and $_POST['student_fname'] and $_POST['student_lname'] and $_POST['student_email'] and $_POST['student_username'] and $_POST['student_password'] and $_POST['class_id'])
{
  $studentFname = $_POST['student_fname'];
  $studentLname = $_POST['student_lname'];
  $studentMname = $_POST['student_mname'];
  $studentEmail = $_POST['student_email'];
  $studentUsername = $_POST['student_username'];
  $studentPassword = $_POST['student_password'];
  $classId = $_POST['class_id'];

  insertStudents($studentFname,$studentLname,$studentMname,$studentEmail,$studentUsername,$studentPassword,$classId);
  generateUserDB($studentUsername);
/* 
  $present = checkStudentbyUsername($studentUsername);
  if($present !== "present"){
  insertStudents($studentFname,$studentLname,$studentMname,$studentEmail,$studentUsername,$studentPassword,$classId);
  generateUserDB($studentUsername);
  
   }else{
     
$present = checkStudentbyUsernameAndPassword($studentUsername,$studentPassword);
echo $present;
  } 
  //echo file_get_contents($studentUsername.'.sqlite');

} */
// readfile('gwen.sqlite');
}
?>