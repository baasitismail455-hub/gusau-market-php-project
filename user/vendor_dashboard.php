<?php
session_start();
include("../includes/connection.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="vendor"){
    header("Location: ../login.php");
    exit();
}

$vendor = $_SESSION['user_id'];

$totalProducts = mysqli_num_rows(mysqli_query($con,
"SELECT * FROM products WHERE vendor_id='$vendor'"));

$myProducts = mysqli_query($con,
"SELECT * FROM products WHERE vendor_id='$vendor' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Vendor Dashboard</title>
<link rel="stylesheet" href="../assets/css/admin.css">

<style>
.card-box{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-bottom:30px;
}

.card{
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.card h1{
color:#14532d;
font-size:38px;
}

.btn-add{
background:#14532d;
color:white;
padding:12px 20px;
text-decoration:none;
border-radius:5px;
}

table{
width:100%;
border-collapse:collapse;
background:white;
}

table th,td{
padding:12px;
border:1px solid #ddd;
}

img{
width:70px;
height:70px;
object-fit:cover;
}

.action{
text-decoration:none;
padding:6px 12px;
border-radius:4px;
color:white;
}

.edit{background:#2563eb;}
.delete{background:red;}
</style>

</head>

<body>

<div class="sidebar">

<h2>Vendor Panel</h2>

<ul>
<li><a href="vendor_dashboard.php">Dashboard</a></li>
<li><a href="vendor_add_product.php">Add Product</a></li>
<li><a href="../cart.php">Orders</a></li>
<li><a href="../logout.php">Logout</a></li>
</ul>

</div>

<div class="main">

<div class="topbar">
<h2>Welcome, <?php echo $_SESSION['fullname']; ?></h2>
</div>

<div class="content">

<div class="card-box">

<div class="card">
<h3>My Products</h3>
<h1><?php echo $totalProducts; ?></h1>
</div>

</div>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
<h2>My Product List</h2>

<a href="vendor_add_product.php" class="btn-add">
+ Add New Product
</a>

</div>

<table>

<tr>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($myProducts)){ ?>

<tr>

<td>
<img src="../uploads/<?php echo $row['image']; ?>">
</td>

<td><?php echo $row['product_name']; ?></td>

<td>₦<?php echo number_format($row['price']); ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>

<a class="action edit"
href="vendor_edit_product.php?id=<?php echo $row['id']; ?>">
Edit
</a>

<a class="action delete"
onclick="return confirm('Delete this product?')"
href="vendor_delete_product.php?id=<?php echo $row['id']; ?>">
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