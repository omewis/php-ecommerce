<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce"; 

  try {
    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  } catch (Exception $e) {
   echo $e->getMessage();
   exit();
  }
  ?>