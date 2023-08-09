<?php

   $db_name = 'mysql:host=localhost;dbname=course_db';
   $user_name = 'root';
   $user_password = '';

   $conn = new PDO($db_name, $user_name, $user_password);

   function unique_id() {
      $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
      $rand = array();
      $length = strlen($str) - 1;
      for ($i = 0; $i < 20; $i++) {
          $n = mt_rand(0, $length);
          $rand[] = $str[$n];
      }
      return implode($rand);
   }



   // <?php
   // $servername = "localhost";
   // $username = "username";
   // $password = "password";
   
   // // Create connection
   // $conn = new mysqli($servername, $username, $password);
   
   // // Check connection
   // if ($conn->connect_error) {
   //   die("Connection failed: " . $conn->connect_error);
   // }
   // echo "Connected successfully";
   // ?> 
?>