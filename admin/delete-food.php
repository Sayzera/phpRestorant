<?php 

$db = include('./database/db.php');
if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}

$imageDelete = $db->query('SELECT * FROM tbl_food WHERE id = '.$_GET['id'].'')->fetch();

$query = $db ->prepare('DELETE FROM tbl_food WHERE id = ?');
$delete = $query->execute(array($_GET['id']));

if($delete) {
    $_SESSION['delete-food'] = 'Food deleted successfuly';
    unlink($imageDelete['image_name']);
    header('location: '.SITEURL.'admin/manage-food.php');
}










?>