<?php

include ('./partials/menu.php');
$db = include('./database/db.php');
if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}

isset($_GET['id']) ? $id = $_GET['id'] : $id = ''; 


?>

<?php 
    // Guncellenecek veriyi inputlara çekmek için gerekli işlemler... 

    $querySelectUpdate = $db->query("SELECT * FROM tbl_order WHERE id = '{$id}' ")->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['update-submit-btn'])) {

            $sql = "UPDATE tbl_order SET status = ? WHERE id=?";
            $update = $db->prepare($sql);
            $update->execute(array($_POST['status'], $id));

            if($update) {
                $_SESSION['update-order'] = 'Updated successfully';
                header('location:'.SITEURL.'admin/manage-order.php');
            }
    }



    
   
?>
<div class="container">
     <div class="wrapper-add-admin">
        <form action="" method="POST">
        <table class="tbl-30">

   
         <tr>
             <td>Status: </td>
             <td>Yes <input type="radio" name="status" id="status" value="Yes" ></td>
             <td>No  <input type="radio" name="status" id="status" value="No"></td>
         </tr>

         <tr>
             <td colspan="2" style="text-align: left;">
                 <button style="width: 100px;" class="btn-secondary" type="submit" name="update-submit-btn">Güncelle</button>
             </td>
         </tr>
       </table>
        </form>
     </div>
</div>




<?php include ('./partials/footer.php'); ?>