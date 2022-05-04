<?php
session_start();
require ("../connect/connect_database.php");
if(isset($_POST["show_favor"])){
    $query = "SELECT * FROM products WHERE favorite=1";
    $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
    $num_rows = mysqli_num_rows($result);

    echo '<div class="catalog" id="catal">';
    for ($i = 0; $i < $num_rows; $i++) {
        $row = mysqli_fetch_array($result);
        echo '<div class="elem">
            <img class="img" src="../img/'.$row[4].'" alt="" width="auto">
            <p class="text_prod1">'.$row[1].'</p>
            <p class="text_prod2">'.$row[3].'</p>
            <p class="text_prod1">'.$row[5].'+</p>
            <p class="text_prod3">$'.$row[2].'</p>
            <form id="form_fav" name="test" method="post" action="" onsubmit="return false;">
            <input class="favor" id="fav" name="favorit" type="submit" value="1" style="">
            </form>
            </div>';
    }
    echo '</div>';

}
?>