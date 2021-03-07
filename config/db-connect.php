<?php 
session_start();
define('SITEURL','http://localhost/');


try {
    $db = new PDO('mysql:host=remotemysql.com;dbname=ItwHklGlzy','ItwHklGlzy','7I5a2Rq3fd');

} catch (PDOException $e) {
    echo $e->getMessage();
}

return $db;


?>
