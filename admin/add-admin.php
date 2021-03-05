<?php 
$db = include('./database/db.php');

if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}

include ('./partials/menu.php');

?>

<?php 
    if(isset($_POST['add-submit-btn'])) {
        $data = [];
        $formErrors = [];

        foreach ($_POST as $key => $value) {
            if($key != 'add-submit-btn') {
                $data[$key] = $value;


                if($value =='') {
                    array_push($formErrors, $key.': Boş olmaz');
                }
                
            }
        }
      

        if(count($formErrors) == 0 ) {
            // her şey yolundaysa formu yolla
            $query = $db->prepare("INSERT INTO tbl_admin SET
            full_name = ?,
            username = ?,
            password = ?");
    
            $insert = $query->execute((array(
               $data['full_name'], $data['username'], md5($data['password'])
            )));

            $db = null;
            echo 'eklendi';
            $_SESSION['add'] = "Admin added successfully";
            
            header("location:".SITEURL."admin/manage-admin.php");
        } else {
            echo '<pre>';
            print_r($formErrors);
            echo '</pre>';
            $_SESSION['add'] = "Failed to add Admin";
       
            header("location:".SITEURL."admin/add-admin.php");
        }

    } else {    
        ?>

<div class="container">
     <div class="wrapper-add-admin">
        <form action="" method="POST">
        <table class="tbl-30">
       <tr>
             <td>Full name: </td>
             <td><input type="text" name="full_name" id="full_name" placeholder="Enter You Name"></td>
         </tr>
         <tr>
             <td>User Name: </td>
             <td><input type="text" name="username" id="username" placeholder="Enter You Name"></td>
         </tr>
         <tr>
             <td>Password: </td>
             <td><input type="text" name="password" id="password" placeholder="Enter you password"></td>
         </tr>

         <tr>
             <td colspan="2" style="text-align: right;">
                 <button style="width: 100px;" class="btn-secondary" type="submit" name="add-submit-btn">Ekle</button>
             </td>
         </tr>
       </table>
        </form>
     </div>
</div>
        <?php
    }

?>


<?php include ('./partials/footer.php'); ?>