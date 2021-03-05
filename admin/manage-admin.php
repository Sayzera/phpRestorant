<?php
include('./partials/menu.php');

$db = include('./database/db.php');

if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}



// Tüm adminleri göster 
$query = $db->query("SELECT * FROM tbl_admin", PDO::FETCH_ASSOC);


?>

<!--Main content section starts -->

<div class="manage-content">
    <div style="text-align:right">
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
    </div>
    <div class="wrapper">
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br>

        <table class="table-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Actions</th>
            </tr>
            <?php
            if ($query->rowCount()) {
                $count = 0 ;
                foreach ($query as $adminTable) {
            ?>
                    <tr>
                        <td><?php echo $count +=1?></td>
                        <td><?php echo $adminTable['full_name']?></td>
                        <td><?php echo $adminTable['username']?></td>
                        <td>
                            <a href="<?php echo SITEURL.'admin/update-admin.php?id='.$adminTable['id'].' ' ?>" class="btn-secondary">Update Admin</a>
                            <a href="<?php echo SITEURL.'admin/delete-admin.php?id='.$adminTable['id'] ?>&kullanici_adi=<?php echo $adminTable['username'] ?>" class="btn-danger">Delete</a>
                        </td>

                    </tr>
            <?php
                }
            } else {
                ?>
                  <tr>
                        <td colspan="4">
                            Listelenecek admin bulunamadı
                        </td>

                    </tr>
                <?php
            }
            ?>
        </table>
    </div>

</div>
</div>

<?php include('./partials/footer.php') ?>