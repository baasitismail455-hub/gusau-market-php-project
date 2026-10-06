<?php
session_start();
include("../includes/connection.php");

$result = mysqli_query($con, "
SELECT products.*, categories.category_name
FROM products
JOIN categories
ON products.category_id = categories.id
ORDER BY products.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<link rel="stylesheet" href="../assets/css/admin.css">

<style>
table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

table th,table td{
    padding:12px;
    border:1px solid #ddd;
}

img{
    width:70px;
    height:70px;
    object-fit:cover;
}
</style>

</head>

<body>

<div class="sidebar">
<h2>Gusau Market</h2>

<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="add_product.php">Add Product</a></li>
<li><a href="products.php">Products</a></li>
</ul>
</div>

<div class="main">

<div class="topbar">
<h2>All Products</h2>
</div>

<div class="content">

<table>

<tr>

<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Quantity</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td>
<img src="../uploads/<?php echo $row['image']; ?>">
</td>

<td><?php echo $row['product_name']; ?></td>

<td>₦<?php echo number_format($row['price']); ?></td>

<td><?php echo $row['quantity']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>