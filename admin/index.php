<?php
$db = include('./database/db.php');

if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}

include('./partials/menu.php'); 

$admin = $db->query('SELECT * FROM tbl_admin')->fetchAll();
$category = $db->query('SELECT * FROM tbl_category')->fetchAll();

// Sadece onaylıları göster
$order = $db->query('SELECT * FROM tbl_order')->fetchAll();

$food = $db->query('SELECT * FROM tbl_food')->fetchAll();

?>


    <!--Main content section starts -->
    <div class="main-content">
      
        <div class="wrapper">
           
        <div>
                <h3><?php echo count($admin); ?></h3>
                <p>Adminler</p>
            </div>
            <div>
                <h3><?php echo count($category); ?></h3>
                <p>Kategoriler</p>
            </div>

            <div>
                <h3><?php echo count($order); ?></h3>
                <p>Siparişler</p>
            </div>
            <div>
                <h3><?php echo count($food); ?></h3>
                <p>Yemekler</p>
            </div>


            
        

           
        </div>
    </div>
    <!--Main content section end -->


<?php include('./partials/footer.php') ?>