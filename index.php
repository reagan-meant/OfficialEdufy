<?php
include_once 'app/dao/tables.php';
$createMissingTables=createTables();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EDUFY</title>
    <link rel="stylesheet" href="app/resources/bootstrap.min.css">
    <link rel="stylesheet" href="app/resources/global.css">
    <script src="app/resources/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h1>Welcome to Edufy</h1>
        </div>
       <a  class="btn btn-warning  btn-lg btn-block" href="app/forms/subjects.php">Add Subject</a>
       <a  class="btn btn-primary  btn-lg btn-block" href="app/forms/class.php">Add Class</a>
        <a  class="btn btn-secondary  btn-lg btn-block" href="app/forms/students.php">Register Student</a>
        <a  class="btn btn-success  btn-lg btn-block" href="app/forms/QA.php">Add Question and Answers</a>
    </div>
</body>

</html>