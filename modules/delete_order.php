<?php
session_start();
require ("../connect/connect_database.php");
$pieces = explode("\n", $_GET["message"]);
$query3 = "SELECT id_product FROM products WHERE name_product='".$pieces[0]."'";
$result3 = mysqli_query($_SESSION["link"], $query3) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$row1 = mysqli_fetch_array($result3);
$query4 = "SELECT order_id FROM bag WHERE id_user='".$_SESSION["user_id"]."' AND order_id != 0";
$result4 = mysqli_query($_SESSION["link"], $query4) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$row4 = mysqli_fetch_array($result4);
$query5 = 'SELECT order_id FROM order_prod WHERE user_id="'.$_SESSION["user_id"].'"';
$result5 = mysqli_query($_SESSION["link"], $query5) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$rowOrd = mysqli_fetch_array($result5);
if($rowOrd[0] == $row4[0]){
    $query6 = "DELETE FROM bag WHERE order_id='".$rowOrd[0]."' AND id_user='".$_SESSION["user_id"]."' AND order_id!=0";
    $result6 = mysqli_query($_SESSION["link"], $query6) or die("Ошибка" . mysqli_error($_SESSION["link"]));
}
$query1 = "DELETE FROM order_prod WHERE order_id=".$row4[0]." AND user_id='".$_SESSION["user_id"]."'";
$result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));
return;
?>
