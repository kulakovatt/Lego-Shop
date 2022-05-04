<?php
session_start();
require ("../connect/connect_database.php");
$pieces = explode("\n", $_GET["message"]);
$query3 = "SELECT id_product FROM products WHERE name_product='".$pieces[0]."'";
$result3 = mysqli_query($_SESSION["link"], $query3) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$row1 = mysqli_fetch_array($result3);
$query1 = "DELETE FROM bag WHERE id_product='".$row1[0]."' AND id_user='".$_SESSION["user_id"]."'";
$result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));
return;
?>
