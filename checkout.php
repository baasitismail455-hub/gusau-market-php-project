<?php
session_start();
include("includes/connection.php");

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$uid=$_SESSION['user_id'];

$cart=mysqli_query($con,"
SELECT cart.*,products.price
FROM cart
JOIN products
ON cart.product_id=products.id
WHERE customer_id='$uid'
");

$total=0;

while($item=mysqli_fetch_assoc($cart)){
    $total += $item['price']*$item['quantity'];
}

mysqli_query($con,"
INSERT INTO orders(customer_id,total_amount)
VALUES('$uid','$total')
");

$order_id=mysqli_insert_id($con);

$cart=mysqli_query($con,"
SELECT cart.*,products.price
FROM cart
JOIN products
ON cart.product_id=products.id
WHERE customer_id='$uid'
");

while($item=mysqli_fetch_assoc($cart)){

mysqli_query($con,"
INSERT INTO order_items(order_id,product_id,quantity,price)
VALUES('$order_id',
'{$item['product_id']}',
'{$item['quantity']}',
'{$item['price']}')
");

}

mysqli_query($con,"
DELETE FROM cart
WHERE customer_id='$uid'
");

echo "<script>
alert('Order Placed Successfully');
window.location='user/customer_dashboard.php';
</script>";
?>