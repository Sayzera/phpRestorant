<?php
$db = include('./database/db.php');

if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}

include('./partials/menu.php');
?>
    <!--Main content section starts -->
      
    <div class="manage-content">
 
        <div class="wrapper">
          
            <table class="table-full">
                <tr>
                    <th>S.N</th>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Actions</th>
                </tr>

     
                <tr>
                    <td>1.</td>
                    <td>Vijay Thapa </td>
                    <td>Vijathapa</td>
                    <td>
                       <a href="" class="btn-secondary">Update Admin</a>
                       <a href="" class="btn-danger">Delete</a>
                    </td>

                </tr>

            </table>
         
        </div>
        
    </div>

<?php include('./partials/footer.php') ?>