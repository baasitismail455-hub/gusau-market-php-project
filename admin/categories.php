<?php
session_start();
include("../includes/connection.php");

if($_SESSION['role']!="admin"){
header("Location:../login.php");
}

if(isset($_POST['save'])){

$name=$_POST['category'];

mysqli_query($con,"INSERT INTO categories(category_name)
VALUES('$name')");

header("Location:categories.php");

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Categories</title>
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="sidebar">
<h2>Gusau Market</h2>

<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="categories.php">Categories</a></li>
<li><a href="../logout.php">Logout</a></li>
</ul>

</div>

<div class="main">

<div class="topbar">
<h2>Product Categories</h2>
</div>

<div class="content">

<div class="table-box">

<form method="POST">

<input
type="text"
name="category"
placeholder="Enter Category Name"
style="padding:12px;width:300px;">

<button
name="save"
style="padding:12px 20px;background:green;color:white;border:none;">
Save
</button>

</form>

<br>

<table border="1" cellpadding="12" cellspacing="0" width="100%">

<tr>
<th>ID</th>
<th>Category</th>
</tr>

<?php

$result=mysqli_query($con,"SELECT * FROM categories");

while($row=mysqli_fetch_assoc($result))
{

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['category_name']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

</div>

</body>
</html>