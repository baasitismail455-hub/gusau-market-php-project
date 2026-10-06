<?php
session_start();
include("../includes/connection.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin"){
    header("Location: ../login.php");
    exit();
}

// Delete vendor
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($con, "DELETE FROM users WHERE id='$id' AND role='vendor'");
    header("Location: vendors.php");
    exit();
}

// Fetch all vendors
$vendors = mysqli_query($con, "SELECT * FROM users WHERE role='vendor' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vendors</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <style>
        table{
            width:100%;
            border-collapse:collapse;
            background:#fff;
        }
        th,td{
            border:1px solid #ddd;
            padding:12px;
            text-align:left;
        }
        .delete{
            background:#dc2626;
            color:#fff;
            padding:6px 12px;
            text-decoration:none;
            border-radius:4px;
        }
    </style>
</head>
<body>

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

<div class="main">
    <div class="topbar">
        <h2>Registered Vendors</h2>
    </div>

    <div class="content">
        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($vendors)){ ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['fullname']; ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['phone']; ?></td>
                <td>
                    <a class="delete"
                       href="?delete=<?= $row['id']; ?>"
                       onclick="return confirm('Delete this vendor?')">
                       Delete
                    </a>
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>
</div>

</body>
</html>