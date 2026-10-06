<?php
session_start();
include("includes/connection.php");

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
    $sql = "SELECT * FROM products
            WHERE product_name LIKE '%$search%'
            ORDER BY id DESC";
}else{
    $sql = "SELECT * FROM products ORDER BY id DESC";
}

$products = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Gusau General Market</title>
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<!-- ================= NAVBAR ================= -->

<div class="navbar">
    <div class="container nav-content">

        <div class="logo-area">
            <img src="assets/images/logo.png" class="logo-img" alt="Logo">
            <div>
                <h2>Gusau Market</h2>
                <small>Online General Market</small>
            </div>
        </div>

        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="#shop">Shop</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="cart.php">Cart</a>
        </div>

    </div>
</div>

<!-- ================= HERO ================= -->

<section class="hero">

    <div class="container">

        <div class="hero-text">

            <h1>Welcome to Gusau General Market</h1>

            <p>
                Buy groceries, fashion, electronics and more from trusted vendors across Gusau.
            </p>

            <a href="#shop" class="btn">Shop Now</a>

        </div>

    </div>

</section>

<!-- ================= PRODUCTS ================= -->

<section id="shop" class="products-section">

    <div class="container">

        <h2 class="section-title">Available Products</h2>

        <form method="GET" class="search-box">

            <input
                type="text"
                name="search"
                placeholder="Search products..."
                value="<?php echo $search; ?>">

            <button type="submit">Search</button>

        </form>

        <div class="product-grid">

            <?php while($row = mysqli_fetch_assoc($products)){ ?>

                <div class="product-card">

                    <img src="uploads/<?php echo $row['image']; ?>" alt="">

                    <h3>
                        <a href="product.php?id=<?php echo $row['id']; ?>">
                            <?php echo $row['product_name']; ?>
                        </a>
                    </h3>

                    <p class="price">
                        ₦<?php echo number_format($row['price']); ?>
                    </p>

                    <a href="add_cart.php?id=<?php echo $row['id']; ?>" class="buy-btn">
                        Add to Cart
                    </a>

                </div>

            <?php } ?>

        </div>

    </div>

</section>

<!-- ================= ABOUT ================= -->

<section class="about">

    <div class="container about-grid">

        <div>

            <h2>About Gusau General Market</h2>

            <p>
                Gusau General Market is one of the largest commercial markets in Zamfara State,
                bringing together traders selling groceries, electronics, clothing, cosmetics,
                agricultural products and household items. This web platform enables customers
                to buy products online while helping local businesses reach more buyers across Nigeria.
            </p>

            <a href="#" class="btn">Learn More</a>

        </div>

        <div>
            <img src="assets/images/about.jpg" class="about-img" alt="">
        </div>

    </div>

</section>

<!-- ================= FOOTER ================= -->

<footer>

    <div class="container footer-grid">

        <div>

            <h3>Gusau Market</h3>

            <p>
                Your trusted online marketplace connecting customers with verified traders
                across Gusau General Market.
            </p>

        </div>

        <div>

            <h3>Quick Links</h3>

            <p><a href="index.php">Home</a></p>
            <p><a href="#shop">Products</a></p>
            <p><a href="#">Contact</a></p>

        </div>

        <div>

            <h3>Contact</h3>

            <p>📍 Gusau, Zamfara State</p>
            <p>📞 08107667494</p>
            <p>✉ info@gusaumarket.com</p>

        </div>

    </div>

    <div class="copyright">
        © 2026 Gusau General Market. All Rights Reserved.
    </div>

</footer>

</body>
</html>