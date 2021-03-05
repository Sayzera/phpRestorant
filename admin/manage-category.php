<?php
$db = include('./database/db.php');

if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}


include('./partials/menu.php');
?>






<!--- main  ---->

    <!--Main content section starts -->
    <div style="display:block">Manage Category<div>
    <div class="main-content">
 
        <div class="wrapper">
          

         
        </div>
    </div>




<!--- main end ---->
















<?php include('./partials/footer.php') ?>