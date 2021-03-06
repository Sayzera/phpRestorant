<?php 
$db = include('./database/db.php');
if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}
include ('./partials/menu.php');

// category sql 

$category = $db->query('SELECT * FROM tbl_category')->fetchAll();


?>

<div class="container">
     <div class="wrapper-add-admin">
        <form action="" method="POST" enctype="multipart/form-data" >
        <table class="tbl-30">
        <tr>
             <td>Title:</td>
             <td><input type="text" name="title" id="title" placeholder="Category Title"></td>
         </tr>
         <tr>
             <td>Price: </td>
             <td><input type="text" name="price" id="price" placeholder="Price"></td>
         </tr>

         <tr>
             <td>Descriptipn </td>
             <td><textarea name="description" id="description" placeholder="Açıklama yazınız" cols="30" rows="5"></textarea></td>
         </tr>

         <tr>
             <td>Select İmage: </td>
             <td>
                 <input type="file" name="image_file">
             </td>
         </tr>
         <tr>
             <td>Select Category</td>
             <td>
                <select name="categories" id="categories">
                    <?php 
                    foreach ($category as $value) {
                        ?>
                            <option value="<?php echo $value['id']?>"><?php echo $value['title'] ?></option>
                        <?php
                    }
                    ?>
                   
                </select>
             </td>
         </tr>
         <tr>
             <td>Featured: </td>
             <td>
                 <input type="radio" name="featured" id="featured" value="Yes"> Yes
                 <input type="radio" name="featured" id="featured" value="No"> No
             </td>
         </tr>
         <tr>
             <td>Active: </td>
             <td>
                   <input type="radio" name="active" id="active " value="Yes"> Yes
                   <input type="radio" name="active" id="active " value="No"> No
             </td>
         </tr>
   
         <tr>
            <td colspan="2" style="position:relative">
                <input type="submit" name="add_category_submit" id="add-category-submit" value="Ekle" class="btn">
            </td> 
         </tr>
       </table>
        </form>
     </div>
</div>
        <?php

?>

<?php 


if(isset($_POST['add_category_submit'])) {
    // diğer eklenecek verileri alalım
    $title = @$_POST['title'] ;
    $featured = @$_POST['featured'];
    $active = @$_POST['active'];
    $price = @$_POST['price'];
    $description = @$_POST['description'];
    $categori_id = @$_POST['categories'];




    // Resim ekleme 
    $target_dir = '../images/';
    // dosyanın yolunu veriyorum
    $target_file = $target_dir.basename($_FILES['image_file']['name']);
  
    // Dosyayı ekleme işlemi 
        if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
            // SQL kayıt edelim 
            $sql = "INSERT INTO tbl_food SET 
            title = ? ,
            image_name = ?,
            featured = ? ,
            price = ?,
            description = ?,
            active = ?,
            category_id = ?  "; 
            $query = $db->prepare($sql);
            $insert = $query->execute(array(
               $title,
               $target_file,
               $featured,
               $price,
               $description,
               $active,
               $categori_id,
            ));
        
            header('location: '.SITEURL.'admin/manage-food.php');
            $_SESSION['food-add'] = 'Food added succesfuly';
        }        

    } 

?>


<?php include ('./partials/footer.php'); ?>