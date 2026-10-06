<?php
session_start();
include("../includes/connection.php");

// Secure Admin Access
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    header("Location: ../login.php");
    exit();
}

// Total Revenue
$revenueQuery = mysqli_query($con,"
SELECT SUM(total_amount) AS revenue
FROM orders
WHERE status='Delivered'
");

$revenueData = mysqli_fetch_assoc($revenueQuery);
$revenue = $revenueData['revenue'] ?? 0;

// Delivered Orders
$delivered = mysqli_num_rows(mysqli_query($con,"
SELECT * FROM orders
WHERE status='Delivered'
"));

// Pending Orders
$pending = mysqli_num_rows(mysqli_query($con,"
SELECT * FROM orders
WHERE status='Pending'
"));

// Confirmed Orders
$confirmed = mysqli_num_rows(mysqli_query($con,"
SELECT * FROM orders
WHERE status='Confirmed'
"));

// Total Customers
$customers = mysqli_num_rows(mysqli_query($con,"
SELECT * FROM users
WHERE role='customer'
"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sales Report</title>

<link rel="stylesheet" href="../assets/css/admin.css">

<style>
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    padding:30px;
}
.card{
    background:#fff;
    border-radius:10px;
    padding:25px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}
.card h3{
    color:#666;
    margin-bottom:10px;
}
.card h1{
    color:#14532d;
    font-size:36px;
}
.table-box{
    margin:30px;
    background:#fff;
    border-radius:10px;
    padding:20px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}
table{
    width:100%;
    border-collapse:collapse;
}
table th,table td{
    border:1px solid #ddd;
    padding:12px;
    text-align:left;
}
table th{
    background:#14532d;
    color:#fff;
}
.print-btn{
    background:#14532d;
    color:#fff;
    padding:12px 20px;
    text-decoration:none;
    border-radius:5px;
    float:right;
    margin-bottom:15px;
}
</style>

</head>
<body>

<!-- Sidebar -->

<div class="sidebar">

    <h2>Gusau Market</h2>

    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="categories.php">Categories</a></li>
        <li><a href="add_product.php">Product</a></li>
        <li><a href="vendors.php">Vendors</a></li>
        <li><a href="customers.php">Customers</a></li>
        <li><a href="orders.php">Orders</a></li>
        <li><a href="report.php">Sales Report</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>

</div>

<!-- Main -->

<div class="main">

    <div class="topbar">
        <h2>Sales Report</h2>
        <h3><?php echo $_SESSION['fullname']; ?></h3>
    </div>

    <!-- Cards -->

    <div class="cards">

        <div class="card">
            <h3>Total Revenue</h3>
            <h1>₦<?php echo number_format($revenue); ?></h1>
        </div>

        <div class="card">
            <h3>Delivered Orders</h3>
            <h1><?php echo $delivered; ?></h1>
        </div>

        <div class="card">
            <h3>Confirmed Orders</h3>
            <h1><?php echo $confirmed; ?></h1>
        </div>

        <div class="card">
            <h3>Pending Orders</h3>
            <h1><?php echo $pending; ?></h1>
        </div>

        <div class="card">
            <h3>Total Customers</h3>
            <h1><?php echo $customers; ?></h1>
        </div>

    </div>

    <!-- Order Table -->

    <div class="table-box">

        <a href="#" onclick="window.print()" class="print-btn">
            Print Report
        </a>

        <h2>Delivered Sales</h2>

        <table>

            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>

            <?php

            $orders = mysqli_query($con,"
            SELECT * FROM orders
            WHERE status='Delivered'
            ORDER BY id DESC
            ");

            while($row = mysqli_fetch_assoc($orders)){

            ?>

            <tr>

                <td>#<?php echo $row['id']; ?></td>

                <td><?php echo $row['customer_id']; ?></td>

                <td>₦<?php echo number_format($row['total_amount']); ?></td>

                <td><?php echo $row['status']; ?></td>

                <td><?php echo $row['order_date']; ?></td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>