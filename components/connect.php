<?php
$db_name= "mall_db";
$db_con = 'mysql:host=localhost;dbname='.$db_name;
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_con, $user_name, $user_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>