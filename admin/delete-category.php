<?php 
$db = include('./database/db.php');
if (!isset($_SESSION['kullanici_bilgileri'])) {
    header('location:' . SITEURL . 'admin/login.php');
}

if(isset($_GET['id'])) {
    $query = $db->prepare('DELETE FROM tbl_category WHERE id = ? ');
    $delete = $query->execute(array($_GET['id']));

    $_SESSION['delete-category'] = 'This category deleted successfuly';
    header('location: '.SITEURL.'admin/manage-category.php');
}

?>