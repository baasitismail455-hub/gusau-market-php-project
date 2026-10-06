<?php
session_start();
include("../includes/connection.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin"){
    header("Location: ../login.php");
    exit();
}

$product = mysqli_num_rows(mysqli_query($con,"SELECT * FROM products"));
$vendor = mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE role='vendor'"));
$customer = mysqli_num_rows(mysqli_query($con,"SELECT * FROM users WHERE role='customer'"));
$order = mysqli_num_rows(mysqli_query($con,"SELECT * FROM orders"));
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>Admin Dashboard</title>

<link rel="stylesheet" href="../assets/css/admin.css">

</head>

<body>

<div class="sidebar">

<h2>Gusau Market</h2>

<ul>

<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="categories.php">Categories</a></li>
<li><a href="add_product.php">Add Product</a></li>
<li><a href="product.php">Products</a></li>
<li><a href="vendors.php">Vendors</a></li>
<li><a href="customers.php">Customers</a></li>
<li><a href="orders.php">Orders</a></li>
<li><a href="report.php">Sales Report</a></li>
<li><a href="../logout.php">Logout</a></li>

</ul>

</div>

<div class="main">

<div class="topbar">

<h2>Administrator Dashboard</h2>

<h3><?php echo $_SESSION['fullname']; ?></h3>

</div>

<div class="cards">

<div class="card">
<h3>Total Products</h3>
<h1><?php echo $product; ?></h1>
</div>

<div class="card">
<h3>Vendors</h3>
<h1><?php echo $vendor; ?></h1>
</div>

<div class="card">
<h3>Customers</h3>
<h1><?php echo $customer; ?></h1>
</div>

<div class="card">
<h3>Orders</h3>
<h1><?php echo $order; ?></h1>
</div>

</div>

<div class="content">

<div class="table-box">

<h2>Welcome to Gusau General Market</h2>

<p style="margin-top:15px;line-height:28px;">
This dashboard allows the administrator to manage products,
vendors, customers, categories and customer orders from one place.
</p>

</div>

</div>

</div>

</body>
</html>