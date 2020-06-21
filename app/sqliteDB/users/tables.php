<?php

$commands = [
    'CREATE TABLE IF NOT EXISTS levels (
        level_id INT AUTO_INCREMENT PRIMARY KEY,
        level_name  VARCHAR (255) NOT NULL)',
    //classes table
    'CREATE TABLE IF NOT EXISTS classes (
        class_id INT AUTO_INCREMENT PRIMARY KEY,
        class_name  VARCHAR (255) NOT NULL,
        level_id INT ,
        FOREIGN KEY (level_id)
        REFERENCES levels(level_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE)',        
    'CREATE TABLE IF NOT EXISTS terms (
        term_id INT AUTO_INCREMENT PRIMARY KEY,
        term_name  VARCHAR (255) NOT NULL,
        class_id INT ,
        FOREIGN KEY (class_id)
        REFERENCES classes(class_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE)',
    //students table
    'CREATE TABLE IF NOT EXISTS students (
                student_id   INT AUTO_INCREMENT PRIMARY KEY,
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
        subject_id INT AUTO_INCREMENT PRIMARY KEY,
        subject_name  VARCHAR (255) NOT NULL,
        class_id INT,
        FOREIGN KEY (class_id)
        REFERENCES classes(class_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE)',
    //Answers table
    'CREATE TABLE IF NOT EXISTS answers (
        answer_id INT AUTO_INCREMENT PRIMARY KEY ,
        option1  VARCHAR (255) NOT NULL,
        option2  VARCHAR (255),
        option3  VARCHAR (255),
        option4  VARCHAR (255))',
    //Questions table
    'CREATE TABLE IF NOT EXISTS questions (
        question_id INT AUTO_INCREMENT PRIMARY KEY ,
        question_text  VARCHAR (255) NOT NULL,
        tag VARCHAR (255) NOT NULL,
        paper_number INT NOT NULL,
        class_id INT,
        term_id INT,
        correct_option INT NOT NULL,
        answer_id INT,
        answered INT DEFAULT 0,
        times_correct INT DEFAULT 0,
        times_wrong INT DEFAULT 0,
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
        mark_id INT AUTO_INCREMENT PRIMARY KEY,
        mark_subject  VARCHAR (255) NOT NULL,
        student_id INT,
        FOREIGN KEY (student_id)
        REFERENCES students(student_id) ON UPDATE CASCADE
                                     ON DELETE CASCADE)',
];

function createSqTables($studentUsername)
{

    global $commands;

    foreach ($commands as $command) {
        $db = new MyDB($studentUsername);
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
