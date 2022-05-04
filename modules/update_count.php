<?php
session_start();
require ("../connect/connect_database.php");
$info = explode("\n", $_GET["name"]);
$count = $_GET["message"];
$query1 = "SELECT * FROM products WHERE name_product='".$info[0]."'";
$result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$num_rows = mysqli_num_rows($result1);
$row = mysqli_fetch_array($result1);
if($count <= $row[6]){
    $query = "UPDATE bag SET count='".$count."' WHERE id_product='".$row[0]."'";
    $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
}
echo $count;
return;
?>