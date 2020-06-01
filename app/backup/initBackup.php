<?php

include_once 'answers.php';
include_once 'questions.php';
include_once 'classes.php';
include_once 'subjects.php';

domu();

function domu()
{
    $answers = backupAnswers();
    $classes = backupClasses();
    $subjects = backupSubjects();
    $questions = backupQuestions();
}
