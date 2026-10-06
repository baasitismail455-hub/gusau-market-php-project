<?php
session_start();
include("../includes/connection.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="admin"){
    header("Location:../login.php");
    exit();
}

if(isset($_POST['save'])){

    $vendor_id = $_SESSION['user_id'];
    $category = $_POST['category'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $image = $_FILES['image']['name'];
    $temp = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp,"../uploads/".$image);

    $sql="INSERT INTO products
    (vendor_id,category_id,product_name,description,price,quantity,image)
    VALUES
    ('$vendor_id','$category','$name','$description','$price','$quantity','$image')";

    if(mysqli_query($con,$sql)){
        $msg="Product Added Successfully";
    }else{
        $msg="Failed to Add Product";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Add Product</title>
<link rel="stylesheet" href="../assets/css/admin.css">

<style>
.form-box{
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,.08);
}

.input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
}

textarea{
    resize:none;
    height:120px;
}

.btn-save{
    background:#14532d;
    color:#fff;
    border:none;
    padding:14px 30px;
    border-radius:5px;
    cursor:pointer;
}

.success{
    background:#d4edda;
    color:#155724;
    padding:12px;
    margin-bottom:15px;
}
</style>

</head>

<body>

<div class="sidebar">
<h2>Gusau Market</h2>

<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="categories.php">Categories</a></li>
<li><a href="add_product.php">Add Product</a></li>
<li><a href="product.php">Products</a></li>
<li><a href="../logout.php">Logout</a></li>
</ul>
</div>

<div class="main">

<div class="topbar">
<h2>Add New Product</h2>
</div>

<div class="content">

<div class="form-box">

<?php
if(isset($msg)){
echo "<div class='success'>$msg</div>";
}
?>

<form method="POST" enctype="multipart/form-data">

<label>Product Name</label>
<input type="text" name="name" class="input" required>

<label>Category</label>
<select name="category" class="input" required>

<option value="">Select Category</option>

<?php
$cat=mysqli_query($con,"SELECT * FROM categories");

while($row=mysqli_fetch_assoc($cat)){
?>

<option value="<?php echo $row['id']; ?>">
<?php echo $row['category_name']; ?>
</option>

<?php } ?>

</select>

<label>Description</label>
<textarea name="description" class="input"></textarea>

<label>Price (₦)</label>
<input type="number" name="price" class="input" required>

<label>Quantity</label>
<input type="number" name="quantity" class="input" required>

<label>Product Image</label>
<input type="file" name="image" class="input" required>

<button class="btn-save" name="save">
Save Product
</button>

</form>

</div>

</div>

</div>

</body>
</html>