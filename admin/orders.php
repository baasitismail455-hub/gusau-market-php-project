<?php
session_start();
include("../includes/connection.php");

if(isset($_GET['confirm'])){
$id=$_GET['confirm'];
mysqli_query($con,"
UPDATE orders
SET status='Confirmed'
WHERE id='$id'
");
header("Location:orders.php");
}

if(isset($_GET['deliver'])){
$id=$_GET['deliver'];
mysqli_query($con,"
UPDATE orders
SET status='Delivered'
WHERE id='$id'
");
header("Location:orders.php");
}

$orders=mysqli_query($con,"
SELECT orders.*,users.fullname
FROM orders
JOIN users
ON orders.customer_id=users.id
ORDER BY orders.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Orders</title>

<link rel="stylesheet" href="../assets/css/admin.css">

<style>
table{
width:100%;
background:white;
border-collapse:collapse;
}
table th,td{
padding:12px;
border:1px solid #ddd;
}
.btn{
padding:7px 12px;
text-decoration:none;
color:white;
border-radius:4px;
}
.confirm{background:#14532d;}
.deliver{background:#2563eb;}
</style>

</head>

<body>

<div class="sidebar">
<h2>Gusau Market</h2>

<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="orders.php">Orders</a></li>
</ul>
</div>

<div class="main">

<div class="topbar">
<h2>Customer Orders</h2>
</div>

<div class="content">

<table>

<tr>

<th>Order ID</th>
<th>Customer</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($orders)){ ?>

<tr>

<td>#<?= $row['id']; ?></td>

<td><?= $row['fullname']; ?></td>

<td>₦<?= number_format($row['total_amount']); ?></td>

<td><?= $row['status']; ?></td>

<td>

<?php if($row['status']=="Pending"){ ?>

<a class="btn confirm"
href="?confirm=<?= $row['id']; ?>">
Confirm
</a>

<?php } ?>

<?php if($row['status']=="Confirmed"){ ?>

<a class="btn deliver"
href="?deliver=<?= $row['id']; ?>">
Deliver
</a>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>