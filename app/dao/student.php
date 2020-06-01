
<?php
include_once 'db_connection.php';
include_once '../user/answers.php';
include_once '../user/classes.php';
include_once '../user/questions.php';
include_once '../user/subjects.php';


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
    header("Location:http://localhost/edufy/app/forms/students.php");
} 


function insertStudents($studentFname,$studentLname,$studentMname,$studentEmail,$studentUsername,$studentPassword,$classId) 
    {
  $conn = OpenCon();
  
  $query = $conn->prepare("INSERT INTO students(student_fname,student_lname,student_mname,student_email,student_username,student_password,class_id) VALUES (?,?,?,?,?,?,?)");
  $query->bind_param("ssssssi", $studentFname,$studentLname,$studentMname,$studentEmail,$studentUsername,$studentPassword,$classId);


  if ($query->execute()) {
    createDB($studentUsername,$conn);
    userAnswers($studentUsername);
    userClasses($studentUsername);
    userSubjects($studentUsername);
    userQuestions($studentUsername);
    CloseCon($conn);
    return true;
  } else {
    return $conn->error;
  }
}

function getStudents()
{
  $conn = OpenCon();
  $result = $conn->query("SELECT * FROM students");
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

function createDB($studentUsername, $conn)
{
    $sql = "CREATE DATABASE " . $studentUsername . " DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
    if (empty(mysqli_fetch_array(mysqli_query($conn, "SHOW DATABASES LIKE '$studentUsername'")))) {

        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully with the name " . $studentUsername;

            //creating user Tables
            createUserTables($studentUsername);
        } else {

            echo "Error creating database: " . $conn->error;
        }
    }
    // closing connection
    CloseCon($conn);
}
?>
