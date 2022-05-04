<?php
session_start();
require ("../connect/connect_database.php");

$summary = 0;
$query1 = 'SELECT bag.count, products.price_product FROM bag INNER JOIN products ON bag.id_product = products.id_product WHERE bag.id_user ="'.$_SESSION["user_id"].'"';
$result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$rows = mysqli_num_rows($result1);
for($i = 0; $i < $rows; ++$i){
    $row = mysqli_fetch_row($result1);
    $summary += $row[0] * $row[1];

}

$d = strtotime("+0 day");
$payment = $_POST["payment_meth"];
$address = $_POST["address"];
$phone = $_POST["phone"];


?>


<link rel="stylesheet" href="../css/form_order.css">

<div class="title_panel">
    <p class="title_h3">Оформление заказа</p>
</div>

<form action="form_order.php" method="post" class="to_order_container">

    <div class="inputs">
        <p>Заказ на сумму: $<?php echo $summary?></p>
        <p>Способ оплаты</p>
        <div class="payment_method">
            <div>
                <input type="radio" id="payment_method1" name="payment_meth" value="карта" checked>
                <label for="payment_method1">Карта</label>
            </div>
            <div>
                <input type="radio" id="payment_method2" name="payment_meth" value="наличные">
                <label for="payment_method2">Наличные</label>
            </div>
        </div>
        <p>Дата</p>
        <input type="text" class="input_account input_account_date" name="date" size="25" maxlength="25" value="<?=date("d.m.Y", $d)?>">
        <p>Адрес доставки</p>
        <input type="text" class="input_account" name="address" size="25" maxlength="25" value="адрес">
        <p>Телефон для связи</p>
        <input type="text" class="input_account" name="phone" size="25" maxlength="25" value="телефон">

        <input type="submit" name="toorder" value="заказать" class="btn-1">
    </div>
</form>

<?php
if(isset($_POST["toorder"])){
$query3 = 'INSERT INTO order_prod(user_id, summary_price, payment, address, phone, date_order) VALUES ("'.$_SESSION["user_id"].'", "'.$summary.'", "'.$payment.'", "'.$address.'", "'.$phone.'", "'.$_POST["date"].'")';
$result3 = mysqli_query($_SESSION["link"], $query3) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$query4 = 'SELECT order_id FROM order_prod WHERE user_id="'.$_SESSION["user_id"].'"';
$result4 = mysqli_query($_SESSION["link"], $query4) or die("Ошибка" . mysqli_error($_SESSION["link"]));
$rowOrd = mysqli_fetch_array($result4);
$query5 = 'UPDATE bag SET order_id="'.$rowOrd[0].'" WHERE order_id=0 AND id_user="'.$_SESSION["user_id"].'"';
$result5 = mysqli_query($_SESSION["link"], $query5) or die("Ошибка" . mysqli_error($_SESSION["link"]));
header("Location: private_officeU.php");
}
?>