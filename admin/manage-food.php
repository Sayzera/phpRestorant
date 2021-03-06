<?php
$db = include('./database/db.php');
if (!isset($_SESSION['kullanici_bilgileri'])) {
    header('location:' . SITEURL . 'admin/login.php');
}

$foods = $db->query('SELECT * FROM tbl_food')->fetchAll();

include('./partials/menu.php');
?>
<!--Main content section starts -->

<div class="manage-content">
    <?php
    if(isset($_SESSION['food-update'])) {
        echo $_SESSION['food-update'];  
        unset($_SESSION['food-update']);
    }
    ?>
    <div class="wrapper">
        <a href="<?php echo SITEURL . 'admin/add-food.php' ?>" class="btn-primary">Add Food</a>
        <br>
        <table class="table-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>İmage</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
            if (count($foods) > 0) {
                $counter = 0;
                foreach ($foods as  $value) {
            ?>
                    <tr>
                        <td><?php echo $counter +=1; ?></td>
                        <td><?php echo $value['title'] ?> </td>
                        <td><?php echo $value['price'] ?> </td>
                        <td><img src="<?php echo $value['image_name'] ?> " width="100px" height="100px" alt=""></td>
                        <td><?php echo $value['featured'] ?> </td>
                        <td><?php echo $value['active'] ?> </td>
                        <td>
                            <a href="<?php echo SITEURL.'admin/update-food.php?id='.$value['id'].'' ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL.'admin/delete-food.php?id='.$value['id'].'' ?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>

        </table>
    </div>
</div>

<?php include('./partials/footer.php') ?>