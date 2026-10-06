<?php
session_start();
include("../includes/connection.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="customer"){
    header("Location: ../login.php");
    exit();
}

$products = mysqli_query($con,"SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Customer Dashboard</title>

<link rel="stylesheet" href="../assets/css/style.css">

<style>
.dashboard{
    padding:30px;
}

.welcome{
    background:#14532d;
    color:white;
    padding:20px;
    border-radius:10px;
    margin-bottom:30px;
}

.top-menu{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.cart-btn{
    background:#FFD700;
    color:black;
    padding:10px 18px;
    border-radius:5px;
    font-weight:bold;
}

.product-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:20px;
}

.product-card{
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}

.product-card img{
    width:100%;
    height:200px;
    object-fit:cover;
}

.product-card h3{
    padding:12px;
}

.price{
    color:#14532d;
    font-size:20px;
    font-weight:bold;
    padding:0 12px 12px;
}

.buy-btn{
    display:block;
    text-align:center;
    background:#14532d;
    color:white;
    padding:12px;
    font-weight:bold;
}
</style>

</head>
<body>

<div class="navbar">
<div class="container nav-content">

<div class="logo">Gusau Market</div>

<div class="nav-links">
<a href="../cart.php">Cart</a>
<a href="../logout.php">Logout</a>
</div>

</div>
</div>

<div class="container dashboard">

<div class="welcome">
<h2>Welcome, <?php echo $_SESSION['fullname']; ?></h2>
<p>Browse products and start shopping.</p>
</div>

<div class="top-menu">
<h2>Available Products</h2>

<a href="../cart.php" class="cart-btn">
🛒 View Cart
</a>
</div>

<div class="product-grid">

<?php while($row=mysqli_fetch_assoc($products)){ ?>

<div class="product-card">

<img src="../uploads/<?php echo $row['image']; ?>">

<h3><?php echo $row['product_name']; ?></h3>

<p class="price">
₦<?php echo number_format($row['price']); ?>
</p>

<a href="../add_cart.php?id=<?php echo $row['id']; ?>" class="buy-btn">
Add to Cart
</a>

</div>

<?php } ?>

</div>

</div>

</body>
</html>