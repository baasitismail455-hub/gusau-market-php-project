<?php
session_start();
include("includes/connection.php");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($con,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query)>0){

        $row = mysqli_fetch_assoc($query);

        if(password_verify($password,$row['password'])){

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['role'] = $row['role'];

            if($row['role']=="admin"){
                header("Location: admin/dashboard.php");
            }
            elseif($row['role']=="vendor"){
                header("Location: user/vendor_dashboard.php");
            }
            else{
                header("Location: user/customer_dashboard.php");
            }

            exit();

        }else{
            $error="Incorrect Password";
        }

    }else{
        $error="Account does not exist";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="assets/css/style.css">

<style>
.login-section{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    background:#eef3ee;
}
.login-box{
    width:420px;
    background:#fff;
    padding:35px;
    border-radius:10px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}
.login-box h2{
    text-align:center;
    color:#0B5D1E;
    margin-bottom:25px;
}
.input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
}
.btn-login{
    width:100%;
    padding:14px;
    background:#0B5D1E;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
}
.btn-login:hover{
    background:#084516;
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

<section class="login-section">

<div class="login-box">

<h2>User Login</h2>

<?php if(isset($error)){ ?>
<div class="error"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input
type="email"
name="email"
placeholder="Email Address"
class="input"
required>

<input
type="password"
name="password"
placeholder="Password"
class="input"
required>

<button name="login" class="btn-login">
Login
</button>

</form>

<p style="text-align:center;margin-top:20px;">
Don't have an account?
<a href="register.php">Register</a>
</p>

</div>

</section>

</body>
</html>