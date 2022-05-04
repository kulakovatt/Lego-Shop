<?php
session_start();
require ("../connect/connect_database.php");
$pieces = explode("\n", $_GET["message"]);
$query2 = "SELECT id_user FROM users WHERE login='".$_SESSION["user"]."'";
$result2 = mysqli_query($_SESSION["link"], $query2) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$row = mysqli_fetch_array($result2);
$query3 = "SELECT id_product FROM products WHERE name_product='".$pieces[0]."'";
$result3 = mysqli_query($_SESSION["link"], $query3) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$row1 = mysqli_fetch_array($result3);

if($_GET["val"]==1) {
//    $query = "UPDATE products SET status=1 WHERE name_product='".$pieces[0]."'";
    $query1 = "INSERT INTO bag (id_product,count, id_user) VALUES ('$row1[0]', 1,'$row[0]')";
//    $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
    $result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));

} else if($_GET["val"]==0){
    $query1 = "DELETE FROM bag WHERE id_product='".$row1[0]."'";
    $result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));

}
return;
?>
