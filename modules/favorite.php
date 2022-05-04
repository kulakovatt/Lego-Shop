<?php
session_start();
require ("../connect/connect_database.php");
$pieces = explode("\n", $_GET["message"]);
$query1 = "SELECT id_user FROM users WHERE login='".$_SESSION["user"]."'";
$result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$row = mysqli_fetch_array($result1);
$query2 = "SELECT id_product FROM products WHERE name_product='".$pieces[0]."'";
$result2 = mysqli_query($_SESSION["link"], $query2) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$row1 = mysqli_fetch_array($result2);

if($_GET["val"]==1) {
    $query = "INSERT INTO favorite (id_user, id_product) VALUES ('".$row[0]."', '".$row1[0]."')";
    $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));

} else if($_GET["val"]==0){
    $query = "DELETE FROM favorite WHERE id_product='".$row1[0]."' AND id_user='".$row[0]."'";
    $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
}
return;
?>

