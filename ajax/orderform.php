<?php 

$db = include('../config/db-connect.php');


print_r($_POST);


$query = $db->prepare('INSERT INTO tbl_order SET 
food = ? ,
price = ? ,
qty = ? ,
total = ? ,
customer_name = ?,
customer_contact = ?,
customer_email = ? ,
customer_address= ?');

$insert = $query->execute(array(
    $_POST['title'],
    $_POST['price'],
    $_POST['qty'],
    $_POST['total'],
    $_POST['full-name'],
    $_POST['contact'],
    $_POST['email'],
    $_POST['address']
));

if($insert) {
    echo 'eklendi';
} else {
    echo 'eklenmedi';
}


?>