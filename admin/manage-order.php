<?php
$db = include('./database/db.php');

if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}
include('./partials/menu.php');

$rows = $db->query('SELECT * FROM tbl_order ORDER BY id DESC')->fetchAll();

?>
    <!--Main content section starts -->
      
    <div class="manage-content">
        <?php 
      if(  isset( $_SESSION['order-delete'])) {
           echo  $_SESSION['order-delete'];
           unset( $_SESSION['order-delete']);
       }
        
        ?>
        <div class="wrapper">
            <table class="table-full">
                <tr>
                    <th>Adet</th>
                    <th>Customer Name</th>
                    <th>Customer Concat</th>
                    <th>Customer adress</th>
                    <th>Order Date</th>
                    <th>Food</th>
                    <th>Total</th>
                    <th>Actions</th>

                 </tr>


     
            <?php
            foreach ($rows as $value) {
            ?>
                    <tr <?php echo $value['status'] == 'Yes' ? 'style = background-color:yellow ' : 'style = background-color:red ' ?>>
                    <td><?php echo $value['qty'] ?> </td>
                    <td><?php echo $value['customer_name'] ?> </td>
                    <td><?php echo $value['customer_contact'] ?> </td>
                    <td><?php echo $value['customer_address'] ?> </td>
                    <td><?php echo $value['order_date'] ?> </td>
                    <td><?php echo $value['food'] ?> </td>
                    <td><?php echo $value['total'] ?> </td>
                    <td>
                       <a href="<?php echo SITEURL.'admin/order-update.php?id='.$value['id'].' ' ?>" class="btn-secondary">Update Admin</a>
                       <a href="<?php echo SITEURL.'admin/order-delete.php?id='.$value['id'].' ' ?>" class="btn-danger">Delete</a>
                    </td>

                </tr>
            <?php
            }
            
            ?>

            </table>
         
        </div>
        
    </div>

<?php include('./partials/footer.php') ?>