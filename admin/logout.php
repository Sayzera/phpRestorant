<?php 
$db = include('./database/db.php');
session_destroy();
header('location: '.SITEURL.'admin/login.php');


?>