<?php
$db = include('./database/db.php');
if (!isset($_SESSION['kullanici_bilgileri'])) {
    header('location:' . SITEURL . 'admin/login.php');
}

include('./partials/menu.php');
?>
<!--Main content section starts -->

<div class="manage-content">
    <div class="wrapper">
        <a href="add-category.php" class="btn-primary">Add Category</a>

        <div style="text-align:right">

            <?php
            if (isset($_SESSION['category-add'])) {
                echo 'Category added succesfully';
                unset($_SESSION['category-add']);
            }

            if (isset($_SESSION['delete-category'])) {
                echo 'Category deleted succesfully';
                unset($_SESSION['delete-category']);
            }
            // categori verilerini çekmek için sqlden veri çekme

            $query = $db->query('SELECT * FROM tbl_category', PDO::FETCH_ASSOC);



            ?>
        </div>
        <table class="table-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>İmage</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            if ($query->rowCount() > 0) {
                foreach ($query as $value) {
            ?>
                    <tr>
                        <td>1.</td>
                        <td><?php echo $value['title']?> </td>
                        <td><img src="<?php echo $value['image'] ?>" width="100px" height="100px" alt=""></td>
                        <td><?php echo $value['featured']?></td>
                        <td><?php echo $value['active']?></td>
                        <td>
                            <a href="<?php echo SITEURL.'admin/update-category.php?id='.$value['id'].' ' ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL.'admin/delete-category.php?id='.$value['id'].''?>" class="btn-danger">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo 'gösterilecek veri yok';
            }

            ?>

        </table>
    </div>
</div>

<?php include('./partials/footer.php') ?>