<?php
session_start();
include("../includes/connection.php");

// Check if vendor is logged in
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != "vendor"){
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['save'])){

    $vendor_id   = $_SESSION['user_id'];
    $category    = $_POST['category'];
    $name        = $_POST['name'];
    $description = $_POST['description'];
    $price       = $_POST['price'];
    $quantity    = $_POST['quantity'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $tmp   = $_FILES['image']['tmp_name'];

    // Create unique image name
    $imageName = time() . "_" . $image;

    move_uploaded_file($tmp, "../uploads/" . $imageName);

    $insert = mysqli_query($con,"
        INSERT INTO products
        (vendor_id, category_id, product_name, description, price, quantity, image)
        VALUES
        ('$vendor_id','$category','$name','$description','$price','$quantity','$imageName')
    ");

    if($insert){
        echo "<script>
                alert('Product Added Successfully');
                window.location='vendor_dashboard.php';
              </script>";
        exit();
    }else{
        $error = mysqli_error($con);
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
    width:700px;
    margin:30px auto;
    padding:30px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}
.input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
}
textarea{
    height:120px;
    resize:none;
}
.btn{
    width:100%;
    background:#14532d;
    color:#fff;
    border:none;
    padding:14px;
    border-radius:5px;
    font-size:16px;
    cursor:pointer;
}
.btn:hover{
    background:#0b4a22;
}
.error{
    background:#f8d7da;
    color:#721c24;
    padding:10px;
    margin-bottom:15px;
    border-radius:5px;
}
</style>

</head>
<body>

<div class="form-box">

<h2>Add New Product</h2>

<?php if(isset($error)){ ?>
<div class="error"><?php echo $error; ?></div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">

<label>Product Name</label>
<input type="text" name="name" class="input" required>

<label>Category</label>
<select name="category" class="input" required>

<option value="">Select Category</option>

<?php
$cat = mysqli_query($con,"SELECT * FROM categories ORDER BY category_name");
while($row = mysqli_fetch_assoc($cat)){
?>

<option value="<?php echo $row['id']; ?>">
    <?php echo $row['category_name']; ?>
</option>

<?php } ?>

</select>

<label>Description</label>
<textarea name="description" class="input" required></textarea>

<label>Price (₦)</label>
<input type="number" name="price" class="input" required>

<label>Quantity</label>
<input type="number" name="quantity" class="input" required>

<label>Product Image</label>
<input type="file" name="image" class="input" accept="image/*" required>

<button type="submit" name="save" class="btn">
    Save Product
</button>

</form>

</div>

</body>
</html>