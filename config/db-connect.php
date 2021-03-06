<?php 
session_start();
define('SITEURL','http://localhost/');


try {
    $db = new PDO('mysql:host=localhost;dbname=myproject','root','');

} catch (PDOException $e) {
    echo $e->getMessage();
}

return $db;


?>