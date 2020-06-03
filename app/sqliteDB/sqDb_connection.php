<?php
   class MyDB extends SQLite3 {
      function __construct($name) {
         $this->open($name.'.db');
      }
   }
   ?>