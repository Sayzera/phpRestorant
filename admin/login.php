<?php $db = include('./database/db.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // POST OLMUŞ ise burası çalışacak

        // gelen post değerlerini alalım 
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        // DB sorgulama WHERE 
        $sql = "SELECT * FROM tbl_admin WHERE username = ? AND  password = ? ";
        $sorgula = $db->prepare($sql);
        $sorgula->execute(array($username, $password));
        $row = $sorgula->fetch(PDO::FETCH_ASSOC);


        // $row = $sorgula->fetch(PDO::FETCH_ASSOC);
        if ($row) {

            $_SESSION['kullanici_bilgileri'] =
                [
                    'username' => $row['username'],
                    'password' => $row['password']
                ];


        // kullanıcı var ise admin yönetim sayfasına gönder
         ?>
            <div class="body">
                <div class="center">
                    <?php
                    if (isset($_SESSION['kullanici_bilgileri'])) {
                        echo 'Başarıyla giriş yaptınız yönlendiriliyorsunuz...';
                        header('Refresh:2; url=' . SITEURL . 'admin/manage-admin.php');
                    }
                    ?>
                </div>
            </div>
        <?php

        } else {
        // kullanıcı yoksa tekrar aynı işlemleri yapsın
        ?>
            <div class="body">
                <div class="center">
                    <?php
                    if (!isset($_SESSION['kullanici_bilgileri'])) {
                        echo 'Kullanıcı Bulunamadı';
                        header('Refresh:1; url=' . SITEURL . 'admin/login.php');
                    }
                    ?>
                </div>
            </div>
        <?php
        }
    } else {
        // post olmamış ise burası çalışacak
        ?>

        <div class="body">

            <div class="center">
                <form action="" method="POST">
                    <h1>Login</h1>

                    <div class="text-field">
                        <input type="text" name="username" id="username" placeholder="Kullanıcı adını giriniz">
                        <span></span>
                    </div>

                    <div class="text-field">
                        <input type="text" name="password" id="password" placeholder="Şifrenizi giriniz">
                        <span></span>
                    </div>

                    <div class="pass">
                        Şifrenizmi unuttunuz ?
                        <input type="submit" class="btn" value="Giriş  Yap">
                    </div>

                    <br>
                    <br>

                </form>
            </div>

        </div>
    <?php
    }


    ?>

</body>

</html>