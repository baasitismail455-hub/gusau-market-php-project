<?php
session_start();
include("../includes/connection.php");

$customers=mysqli_query($con,"
SELECT * FROM users
WHERE role='customer'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Customers</title>
<link rel="stylesheet" href="../assets/css/admin.css">

<style>
table{
width:100%;
background:white;
border-collapse:collapse;
}
table th,td{
padding:12px;
border:1px solid #ddd;
}
</style>

</head>
<body>

<div class="sidebar">
<h2>Gusau Market</h2>

<ul>
<li><a href="dashboard.php">Dashboard</a></li>
<li><a href="customers.php">Customers</a></li>
</ul>

</div>

<div class="main">

<div class="topbar">
<h2>Customers</h2>
</div>

<div class="content">

<table>

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>

</tr>

<?php while($row=mysqli_fetch_assoc($customers)){ ?>

<tr>

<td><?= $row['id']; ?></td>
<td><?= $row['fullname']; ?></td>
<td><?= $row['email']; ?></td>
<td><?= $row['phone']; ?></td>

</tr>

<?php } ?>

</table>

</div>
</div>

</body>
</html>