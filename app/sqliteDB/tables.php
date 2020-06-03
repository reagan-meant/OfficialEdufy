<?php
include_once 'sqDb_connection.php';

$commands = [
    //classes table
    'CREATE TABLE IF NOT EXISTS classes (
        class_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        class_name  VARCHAR (255) NOT NULL)',
    //students table
    'CREATE TABLE IF NOT EXISTS students (
                student_id   INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                student_fname TEXT NOT NULL,
                student_lname   TEXT NOT NULL,
                student_mname   TEXT ,
                student_email     TEXT,
                student_username VARCHAR (255),
                student_password   VARCHAR (255),
                class_id INT ,
        FOREIGN KEY (class_id)
        REFERENCES classes(class_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE)',
    //subjects table
    'CREATE TABLE IF NOT EXISTS subjects (
        subject_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        subject_name  VARCHAR (255) NOT NULL,
        class_id INT,
        FOREIGN KEY (class_id)
        REFERENCES classes(class_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE)',
    //Answers table
    'CREATE TABLE IF NOT EXISTS answers (
        answer_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        option1  VARCHAR (255) NOT NULL,
        option2  VARCHAR (255) NOT NULL,
        option3  VARCHAR (255) NOT NULL,
        option4  VARCHAR (255) NOT NULL)',
    //Questions table
    'CREATE TABLE IF NOT EXISTS questions (
        question_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        question_text  VARCHAR (255) NOT NULL,
        tag VARCHAR (255) NOT NULL,
        class_id INT,
        term_id INT,
        correct_option INT NOT NULL,
        answer_id INT,
        subject_id INT,
        FOREIGN KEY (answer_id)
        REFERENCES answers(answer_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE,
                                     
        FOREIGN KEY (class_id)
        REFERENCES classes(class_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE,                
        FOREIGN KEY (subject_id)
        REFERENCES subjects(subject_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE)',
    //marks table
    'CREATE TABLE IF NOT EXISTS marks (
        mark_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
        mark_subject  VARCHAR (255) NOT NULL,
        student_id INT,
        FOREIGN KEY (student_id)
        REFERENCES students(student_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE)',
];

function createTables()
{

    global $commands;

    foreach ($commands as $command) {
        $db = new MyDB('meantex');
        if (!$db) {
            echo $db->lastErrorMsg();
        } else {
            $ret = $db->exec($command);
            if (!$ret) {
                echo $db->lastErrorMsg();
            } else {
                echo "Table created successfully\n";
            }
            $db->close();
        }
    }
}

function createUserTables($studentUsername)
{
    global $commands;
    $conn = OpenCustomCon($studentUsername);
    // execute the sql commands to create new tables
    foreach ($commands as $command) {

        $result = CreateTablesQuery($command, "Table created Successfully", $conn);
    }
    CloseCon($conn);
}
