<?php $db = include('./config/db-connect.php'); ?>
<?php include('./partials-front/header.php'); ?>

<?php

try {
     $categorys =
        $db->query('SELECT * FROM tbl_category WHERE featured = "Yes" AND active = "Yes" LIMIT 3 ')->fetchAll();
        $foots = $db->query('SELECT * FROM tbl_food WHERE featured ="Yes" AND active = "yes"')->fetchAll();
    } catch (PDOException $e) {
    echo $e->getMessage();
}

?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL.'foods.php' ?>" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="search_post" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <!-- categorileri cek -->

        <h2 class="text-center">Explore Foods</h2>

        <?php
        foreach ($categorys as  $value) {
        ?>
            <a href="<?php echo SITEURL.'foods.php?categoryId='.$value['id'].'&category_name='.$value['title'].' '?>">
                <div class="box-3 float-container">
                    <img src="<?php echo $value['image'] ?>" alt="Pizza" class="img-responsive img-curve">

                    <h3 class="float-text text-white"><?php echo  $value['title'] ?></h3>
                </div>
            </a>
        <?php
        }

        ?>






        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php 
        
        foreach ($foots as $value) {
            ?>
               <div class="food-menu-box">
            <div class="food-menu-img">
                <img src="<?php echo $value['image_name'] ?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
            </div>

            <div class="food-menu-desc">
                <h4><?php echo $value['title'] ?></h4>
                <p class="food-price">$ <?php echo $value['price'] ?></p>
                <p class="food-detail">
                    <?php echo substr( $value['description'] ,0 ,200 ).'...'?>
                </p>
                <br>

                <a href="<?php echo SITEURL.'order.php?id='.$value['id'].' ' ?>" class="btn btn-primary">Order Now</a>
            </div>
        </div>
            <?php
        }
        ?>
    
     

 


     


        <div class="clearfix"></div>



    </div>

    <p class="text-center">
        <a href="<?php echo SITEURL.'foods.php' ?>">See All Foods</a>
    </p>
</section>
<!-- fOOD Menu Section Ends Here -->


<?php include('./partials-front/footer.php'); ?>