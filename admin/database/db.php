<?php 
  // Session Start 
  session_start();
  
  define('SITEURL', 'http://localhost/');
  

try {
    $db = new PDO('mysql:host=localhost;dbname=myproject',"root",'');

} catch (PDOException $e) {
    print $e->getMessage();
}

return  $db;
