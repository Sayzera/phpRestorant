<?php $db = include('./config/db-connect.php');


function categoryGoster($par)
{
    $sql = $par;
    global $db;


    return $db->query($sql)->fetchAll();
}


?>

<?php include('./partials-front/header.php'); ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL.'foods.php' ?>" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="search_post" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center"><?php echo isset($_GET['category_name']) ? $_GET['category_name'] : 'Food Menu' ?> </h2>

        <!-- categoriden gelenlere ise saece ilgili kategorinin ürünlerini göstersin -->

        <?php
        if (isset($_GET['categoryId'])) {
            $foods = categoryGoster('SELECT * FROM tbl_food WHERE category_id = ' . $_GET['categoryId'] . '');

            foreach ($foods as $value) {
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="<?php echo $value['image_name'] ?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $value['title'] ?></h4>
                        <p class="food-price"><?php echo $value['price'] ?></p>
                        <p class="food-detail">
                            <?php echo substr($value['description'], 0, 200) . '...'; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL . 'order.php?id=' . $value['id'] . ' ' ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

            <?php
            }
        } elseif (isset($_POST['search_post'])) {
            // hiç bir urun bulamazsa çıktı ver 
            $query = $db->prepare("SELECT * FROM tbl_food WHERE title   LIKE ? ");
            $query->execute(array('%' . $_POST['search'] . '%'));
            $foods = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($foods as $key => $value) {
            ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="<?php echo $value['image_name'] ?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $value['title'] ?></h4>
                        <p class="food-price"><?php echo $value['price'] ?></p>
                        <p class="food-detail">
                            <?php echo substr($value['description'], 0, 200) . '...'; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL . 'order.php?id=' . $value['id'] . ' ' ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            <?php
            }
        } else {
            $foods = categoryGoster('SELECT * FROM tbl_food');
            foreach ($foods as $value) {
            ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="<?php echo $value['image_name'] ?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $value['title'] ?></h4>
                        <p class="food-price"><?php echo $value['price'] ?></p>
                        <p class="food-detail">
                            <?php echo substr($value['description'], 0, 200) . '...'; ?>
                        </p>
                        <br>

                        <a href="<?php echo SITEURL . 'order.php?id=' . $value['id'] . ' ' ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
        <?php
            }
        }





        ?>
        <!--- direk food menuye tıklanlara tum urunleri göstersin  -->






        <div class="clearfix"></div>



    </div>

</section>
<?php include('./partials-front/footer.php'); ?>