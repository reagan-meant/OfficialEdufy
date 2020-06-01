<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass ='password';
 $db = "edufy";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 function OpenConFree()
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass ='password';
 $conn = new mysqli($dbhost, $dbuser, $dbpass) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }

 function OpenCustomCon($db)
 {
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass ='password';
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
function CloseCon($conn)
 {
 $conn -> close();
 }
