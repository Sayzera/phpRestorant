<?php 
$db = include('./database/db.php');
if(!isset($_SESSION['kullanici_bilgileri'])) {  header('location:'.SITEURL.'admin/login.php');}
include ('./partials/menu.php');

?>

<div class="container">
     <div class="wrapper-add-admin">
        <form action="" method="POST" enctype="multipart/form-data" >
        <table class="tbl-30">
        <tr>
             <td>Title </td>
             <td><input type="text" name="title" id="title" placeholder="Category Title"></td>
         </tr>

         <tr>
             <td>Featured: </td>
             <td>
                 <input type="radio" name="featured" id="featured" value="Yes"> Yes
                 <input type="radio" name="featured" id="featured" value="No"> No
             </td>
         </tr>

         <tr>
             <td>Select İmage: </td>
             <td>
                 <input type="file" name="image_file">
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



    // Resim ekleme 
    $target_dir = '../images/';
    // dosyanın yolunu veriyorum
    $target_file = $target_dir.basename( rand().'.'.pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION));
    

  
    $uploatOk = 1;
    $errors = [];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // boyut kontrol
    if($_FILES['image_file']['size'] > 500000 ) {
        $uploatOk = 0;
        array_push($errors, 'dosya boyutu 5 mb geçemez');
    }
    
    // uzantı kontrol 
    if( !($imageFileType == 'png' || $imageFileType =='jpeg' ||  $imageFileType =='jpg'  || $imageFileType == 'gif') ) {
        array_push($errors, 'Dosya uzantıları, png, jpeg, gif olabilir');
        $uploatOk = 0 ;
    } 

    // dosya daha önceden yuklenmiş mi ?
    if(file_exists($target_file)) {
        array_push($errors, 'Bu dosya zaten var');
        $uploatOk = 0;
    }

    // Dosyayı ekleme işlemi 
    if($uploatOk) {
        if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file)) {
            // SQL kayıt edelim 
            $sql = "INSERT INTO tbl_category SET 
            title = ? ,
            image = ?,
            featured = ? ,
            active = ? 
            "; 
            $query = $db->prepare($sql);
            $insert = $query->execute(array(
               $title,
               $target_file,
               $featured ? $featured : 'boş',
               $active
            ));
        
            header('location: '.SITEURL.'admin/manage-category.php');
            $_SESSION['category-add'] = 'Category added succesfuly';
        }        
    }   

    if(count($errors) > 0) {
        print_r($errors);
    }

    } 

?>


<?php include ('./partials/footer.php'); ?>