<?php
if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}

include ('./partials/menu.php');
$db = include('./database/db.php');

isset($_GET['id']) ? $id = $_GET['id'] : $id = ''; 


?>

<?php 
    // Guncellenecek veriyi inputlara çekmek için gerekli işlemler... 

    $querySelectUpdate = $db->query("SELECT * FROM tbl_admin WHERE id = '{$id}' ")->fetch(PDO::FETCH_ASSOC);

    

    if(isset($_POST['add-submit-btn'])) {
        $data = [];
        $formErrors = [];

        foreach ($_POST as $key => $value) {
            if($key != 'add-submit-btn') {
                $data[$key] = $value;
            }
        }

            // sifre değiştirmek ister veya istemezse oluşan koşullar 
            if($data['password'] == '') {
                $data['password'] = $querySelectUpdate['password'];
            } else {
                $data['password'] =  md5($data['password']);
            }


            $sql = "UPDATE tbl_admin SET full_name=?, username=?, password=? WHERE id=?";
            $update = $db->prepare($sql);
            $update->execute(array($data['full_name'], $data['username'], $data['password'], $id));

            if($update) {
                $_SESSION['update'] = 'Updated successfully';
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
    }



    
   
?>
<div class="container">
     <div class="wrapper-add-admin">
        <form action="" method="POST">
        <table class="tbl-30">
       <tr>
             <td>Full name: </td>
             <td><input type="text" name="full_name" id="full_name" value="<?php echo $querySelectUpdate['full_name'] ?>" placeholder="Enter You Name"></td>
         </tr>
         <tr>
             <td>User Name: </td>
             <td><input type="text" name="username" id="username" value="<?php echo $querySelectUpdate['username'] ?>" placeholder="Enter You Name"></td>
         </tr>
         <tr>
             <td>Password: </td>
             <td><input type="text" name="password" id="password"  placeholder="Enter you password"></td>
         </tr>

         <tr>
             <td colspan="2" style="text-align: right;">
                 <button style="width: 100px;" class="btn-secondary" type="submit" name="add-submit-btn">Güncelle</button>
             </td>
         </tr>
       </table>
        </form>
     </div>
</div>




<?php include ('./partials/footer.php'); ?>