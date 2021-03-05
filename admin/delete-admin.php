<?php
$db = include('./database/db.php');

if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}
include('./partials/menu.php');


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $userName = $_GET['kullanici_adi'];


    $query = $db->prepare('DELETE FROM tbl_admin WHERE id = ?');
    $delete = $query->execute(array($id));
    
    
    $_SESSION['delete'] = 'Admin deleted succesfully';
    header('Refresh: 2; url= '.SITEURL.'admin/manage-admin.php');

}

?> 



<div class="container">
    <div class="delete_cart">
        <div>
        <?php
        if($_SESSION['delete']) {
           ?>
            <span style="color:red"> <?php echo $_SESSION['delete'] ?></span> adlı kullanıcı silindi
           <?php
        }        
        ?>
       
        </div>
    </div>
</div>

















<?php include('./partials/footer.php')?> 