<?php
session_start();
$host = "localhost";
$database = "lego_shop";
$user = "root";
$password = "";

$_SESSION["link"] = mysqli_connect($host, $user, $password, $database) or die("Ошибка" . mysqli_error($link));
$_SESSION["link"]->set_charset('utf8');

?>