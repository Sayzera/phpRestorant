<?php 
$db = include('./database/db.php');
if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}
include ('./partials/menu.php');

// category sql 

$category = $db->query('SELECT * FROM tbl_category')->fetchAll();
$update = $db->query('SELECT * FROM tbl_food WHERE id = '.$_GET['id'].' ')->fetch();

?>

<div class="container">
     <div class="wrapper-add-admin">
        <form action="" method="POST" enctype="multipart/form-data" >
        <table class="tbl-30">
        <tr>
             <td>Title:</td>
             <td><input type="text" name="title" value="<?php echo $update['title'] ?>" id="title" placeholder="Category Title"></td>
         </tr>
         <tr>
             <td>Price: </td>
             <td><input type="text" name="price" id="price" value="<?php echo $update['price'] ?>" placeholder="Price"></td>
         </tr>

         <tr>
             <td>Descriptipn </td>
             <td><textarea name="description" id="description"  placeholder="Açıklama yazınız" cols="30" rows="5"><?php echo $update['description'] ?></textarea></td>
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

                    foreach ($category as $valuee) {
                        if($valuee['id'] == $update['category_id']) {
                        
                            ?>
                             <option <?php echo 'selected'?> value="<?php echo $valuee['id']?>">
                             <?php echo $valuee['title'] ?>
                            </option>
                            <?php
                        } else {
                            ?>
                                <option value="<?php echo $valuee['id']?>"><?php echo $valuee['title'] ?></option>
                            <?php
                        }

                        
                    }
                    ?>
                   
                </select>
             </td>
         </tr>
         <tr>
             <td>Featured: </td>
             <td>
                 <input type="radio"  <?php echo $update['featured'] == 'Yes' ? 'checked' : ''   ?> name="featured" id="featured" value="Yes"> Yes
                 <input type="radio"  <?php echo $update['featured'] == 'No' ? 'checked' : ''   ?> name="featured" id="featured" value="No"> No
             </td>
         </tr>
         <tr>
             <td>Active: </td>
             <td>
                   <input type="radio"  <?php echo $update['active'] == 'Yes' ? 'checked' : ''   ?> name="active" id="active " value="Yes"> Yes
                   <input type="radio"   <?php echo $update['active'] == 'No' ? 'checked' : ''   ?> name="active" id="active " value="No"> No
             </td>
         </tr>
   
         <tr>
            <td colspan="2" style="position:relative">
                <input type="submit" name="uptade_food_submit" id="uptade_food_submit" value="Ekle" class="btn">
            </td> 
         </tr>
       </table>
        </form>
     </div>
</div>
        <?php

?>

<?php 


if(isset($_POST['uptade_food_submit'])) {
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

            // Resim silindi..
            unlink($update['image_name']);
    
        } 
        
        $_FILES['image_file']['size'] > 0 ? '' : $target_file = $update['image_name'];
        // SQL kayıt edelim 
        $sql = "UPDATE tbl_food SET 
        title = ? ,
        image_name = ?,
        featured = ? ,
        price = ?,
        description = ?,
        active = ?,
        category_id = ? WHERE id = ?  "; 
        $query = $db->prepare($sql);
        $update = $query->execute(array(
           $title,
           $target_file,
           $featured,
           $price,
           $description,
           $active,
           $categori_id,
           $_GET['id']
        ));

        if($query) {

            header('location: '.SITEURL.'admin/manage-food.php');
            $_SESSION['food-update'] = 'Food updated succesfuly';
        }
    


    } 

?>


<?php include ('./partials/footer.php'); ?>