<?php
session_start();
include("includes/connection.php");

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$customer=$_SESSION['user_id'];
$product=$_GET['id'];

$check=mysqli_query($con,"
SELECT * FROM cart
WHERE customer_id='$customer'
AND product_id='$product'
");

if(mysqli_num_rows($check)>0){

mysqli_query($con,"
UPDATE cart
SET quantity=quantity+1
WHERE customer_id='$customer'
AND product_id='$product'
");

}else{

mysqli_query($con,"
INSERT INTO cart(customer_id,product_id,quantity)
VALUES('$customer','$product',1)
");

}

header("Location:cart.php");
?>