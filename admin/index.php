<?php
$db = include('./database/db.php');

if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}

include('./partials/menu.php'); 
?>


    <!--Main content section starts -->
    <div class="main-content">
      
        <div class="wrapper">
           
        <div>
                <h3>5</h3>
                <p>Categories</p>
            </div>
            <div>
                <h3>5</h3>
                <p>Categories</p>
            </div>

            <div>
                <h3>5</h3>
                <p>Categories</p>
            </div>
            <div>
                <h3>5</h3>
                <p>Categories</p>
            </div>


            
        

           
        </div>
    </div>
    <!--Main content section end -->


<?php include('./partials/footer.php') ?>