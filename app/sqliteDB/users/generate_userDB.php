<?php
include_once 'answers.php';
include_once 'classes.php';
include_once 'questions.php';
include_once 'subjects.php';
include_once 'tables.php';

function generateUserDB($studentUsername){
    createSqTables($studentUsername);
    sqUserAnswers($studentUsername);
    sqUserClasses($studentUsername);
    sqUserSubjects($studentUsername);
    sqUserQuestions($studentUsername);
}
?>