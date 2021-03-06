<?php
$db = include('./database/db.php');
if (!isset($_SESSION['kullanici_bilgileri'])) {
    header('location:' . SITEURL . 'admin/login.php');
}
include('./partials/menu.php');


// sql sorgusu 
$category = $db->query('SELECT * FROM tbl_category WHERE id = ' . $_GET['id'] . '')->fetch();




?>

<div class="container">
    <div class="wrapper-add-admin">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title </td>
                    <td><input type="text" value="<?php echo $category['title'] ?>" name="title" id="title" placeholder="Category Title"></td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" <?php echo $category['featured'] == 'Yes' ? 'checked' : '' ?> name="featured" id="featured" value="Yes"> Yes
                        <input type="radio" <?php echo $category['featured'] == 'No' ? 'checked' : '' ?> name="featured" id="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Select İmage: </td>
                    <td>
                        <input type="file" name="image_file">
                        <img src="<?php echo $category['image'] ?>" width="100" height="100" alt="">
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" <?php echo $category['active'] == 'Yes' ? 'checked' : '' ?> name="active" id="active " value="Yes"> Yes
                        <input type="radio" <?php echo $category['active'] == 'No' ? 'checked' : '' ?> name="active" id="active " value="No"> No
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


if (isset($_POST['add_category_submit'])) {
    // diğer eklenecek verileri alalım
    $title = @$_POST['title'];
    $featured = @$_POST['featured'];
    $active = @$_POST['active'];

    // Resim ekleme 
    $target_dir = '../images/';
    // dosyanın yolunu veriyorum
    $target_file = $target_dir . basename($_FILES['image_file']['name']);

    $uploatOk = 1;
    $errors = [];
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    // boyut kontrol
    if ($_FILES['image_file']['size'] > 500000) {
        $uploatOk = 0;
        array_push($errors, 'dosya boyutu 5 mb geçemez');
    }

    // uzantı kontrol 
    if (!($imageFileType == 'png' || $imageFileType == 'jpeg' ||  $imageFileType == 'jpg'  || $imageFileType == 'gif')) {
        array_push($errors, 'Dosya uzantıları, png, jpeg, gif olabilir');
        $uploatOk = 0;
    }

    // dosya daha önceden yuklenmiş mi ?
    if (file_exists($target_file)) {
        array_push($errors, 'Bu dosya zaten var');
        $uploatOk = 0;
    }

    // Dosyayı ekleme işlemi 
    if ($uploatOk) {
        // Resmi kaydet
        move_uploaded_file($_FILES['image_file']['tmp_name'], $target_file);
    }

    if (count($errors) > 0) {
        print_r($errors);
    }

    // Güncelenecek resim var ise eski olanı sil
    if ($_FILES['image_file']['size'] > 0) {
        unlink($category['image']);
    } else {
        $target_file = $category['image'];
    }

    // SQL kayıt edelim 
    $sql = "UPDATE tbl_category SET 
    title = ? ,
    image = ?,
    featured = ? ,
    active = ? WHERE id = ?
    ";

    // güncelleme işlemini yap
    $query = $db->prepare($sql);
    $insert = $query->execute(array(
        $title,
        $target_file,
        $featured,
        $active,
        $_GET['id']
    ));

    header('location: ' . SITEURL . 'admin/manage-category.php');
    $_SESSION['category-add'] = 'Category added succesfuly';
}

?>


<?php include('./partials/footer.php'); ?>