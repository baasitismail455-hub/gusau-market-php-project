<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "gusau_market_db";

$con = mysqli_connect($host,$user,$password,$database);

if(!$con){
    die("Database Connection Failed");
}

?>