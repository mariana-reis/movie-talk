<?php 
  
  include_once("globals.php");
  
  $db_name = "moviestar";
  $db_host = "localhost";
  $db_user = "root";
  $db_pass = "12345";
  
  $conn = new PDO("mysql:dbname=". $db_name .";host=". $db_host, $db_user, $db_pass);
  
  // habilitar error PDO
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
