<?php $db = include('./config/db-connect.php'); ?>

<?php include('./partials-front/header.php'); ?>

<?php

$category = $db->query('SELECT * FROM tbl_category WHERE featured = "Yes" AND active ="Yes"')->fetchAll();


?>
<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
        foreach ($category as $value) {
        ?>
            <a href="<?php echo SITEURL.'foods.php?categoryId='.$value['id'].'&category_name='.$value['title'].' '?>">
                <div class="box-3 float-container">
                    <img src="<?php echo $value['image'] ?>" alt="Momo" class="img-responsive img-curve">

                    <h3 class="float-text text-white"><?php echo $value['title'] ?></h3>
                </div>
            </a>
        <?php
        }

        ?>






        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('./partials-front/footer.php'); ?>