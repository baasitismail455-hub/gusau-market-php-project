<?php
include("includes/connection.php");

$pass = password_hash("admin123", PASSWORD_DEFAULT);

mysqli_query($con,"UPDATE users SET password='$pass' WHERE email='admin@gusau.com'");

echo "Admin password updated successfully!";
?>