<?php
session_start();
include("includes/connection.php");

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$uid=$_SESSION['user_id'];

$query=mysqli_query($con,"
SELECT cart.*,products.product_name,
products.price,products.image
FROM cart
JOIN products
ON cart.product_id=products.id
WHERE customer_id='$uid'
");

$total=0;
?>

<!DOCTYPE html>
<html>
<head>

<title>Shopping Cart</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th,table td{
    border:1px solid #ddd;
    padding:12px;
}

img{
    width:70px;
}

.total{
    font-size:28px;
    color:green;
    margin-top:20px;
}

.checkout{
    display:inline-block;
    margin-top:20px;
    background:#14532d;
    color:white;
    padding:15px 30px;
}

</style>

</head>

<body>

<div class="container">

<h1 style="margin:30px 0;">
My Shopping Cart
</h1>

<table>

<tr>

<th>Image</th>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Subtotal</th>

</tr>

<?php while($row=mysqli_fetch_assoc($query)){

$sub=$row['price']*$row['quantity'];
$total+=$sub;

?>

<tr>

<td>
<img src="uploads/<?php echo $row['image']; ?>">
</td>

<td><?php echo $row['product_name']; ?></td>

<td>₦<?php echo number_format($row['price']); ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>₦<?php echo number_format($sub); ?></td>

</tr>

<?php } ?>

</table>

<div class="total">

Total:
₦<?php echo number_format($total); ?>

</div>

<a href="checkout.php" class="checkout">

Proceed to Checkout

</a>

</div>

</body>
</html>