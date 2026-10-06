<?php
include("includes/connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>User Registration</title>

<link rel="stylesheet" href="assets/css/style.css">

<style>

.register-section{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    background:#eef3ee;
}

.form-box{
    width:450px;
    background:white;
    padding:35px;
    border-radius:10px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}

.form-box h2{
    text-align:center;
    color:#0B5D1E;
    margin-bottom:25px;
}

.form-group{
    margin-bottom:15px;
}

.form-group label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
}

.form-group input,
.form-group select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:5px;
}

.register-btn{
    width:100%;
    background:#0B5D1E;
    color:white;
    border:none;
    padding:14px;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
}

.register-btn:hover{
    background:#084516;
}

.login-link{
    text-align:center;
    margin-top:20px;
}

.success{
    background:#d4edda;
    color:#155724;
    padding:10px;
    border-radius:5px;
    margin-bottom:15px;
}

.error{
    background:#f8d7da;
    color:#721c24;
    padding:10px;
    border-radius:5px;
    margin-bottom:15px;
}

</style>

</head>

<body>

<section class="register-section">

<div class="form-box">

<h2>Create Account</h2>

<?php

if(isset($_POST['register']))
{

$fullname=$_POST['fullname'];
$email=$_POST['email'];
$phone=$_POST['phone'];
$password=password_hash($_POST['password'],PASSWORD_DEFAULT);
$role=$_POST['role'];

$check=mysqli_query($con,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check)>0)
{
echo "<div class='error'>Email already exists!</div>";
}
else{

$sql="INSERT INTO users(fullname,email,phone,password,role)
VALUES('$fullname','$email','$phone','$password','$role')";

if(mysqli_query($con,$sql))
{
echo "<div class='success'>Registration Successful</div>";
}
else{
echo "<div class='error'>Registration Failed</div>";
}

}

}

?>

<form method="POST">

<div class="form-group">
<label>Full Name</label>
<input type="text" name="fullname" required>
</div>

<div class="form-group">
<label>Email Address</label>
<input type="email" name="email" required>
</div>

<div class="form-group">
<label>Phone Number</label>
<input type="text" name="phone" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<div class="form-group">
<label>Register As</label>
<select name="role" required>
<option value="">Select Role</option>
<option value="customer">Customer</option>
<option value="vendor">Vendor</option>
</select>
</div>

<button class="register-btn" name="register">
Create Account
</button>

</form>

<div class="login-link">
Already have an account?
<a href="login.php">Login</a>
</div>

</div>

</section>

</body>
</html>