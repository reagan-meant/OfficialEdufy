<?php
include_once '../sqDb_connection.php';
//include_once 'tables.php';


 $db = new MyDB('meantex');
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened sqlite database successfully\n";
   } 

  // createTables();
?>