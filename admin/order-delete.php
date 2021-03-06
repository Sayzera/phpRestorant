<?php 
 $db = include('./database/db.php');

  
 $query = $db->prepare('DELETE FROM tbl_order WHERE id = ?');
 $delete = $query->execute(array($_GET['id']));

 if($delete) {
     echo 'başarıyla silindi';
 }

 header('location:'.SITEURL.'admin/manage-order.php');
 $_SESSION['order-delete'] = 'Başarıyla silindi';

?>