<?php
session_start();
require ("../connect/connect_database.php");
if(isset($_POST["search"])){
    $str_search = $_POST["search"];
    $query = "SELECT * FROM products WHERE name_product LIKE '%$str_search%' OR theme_product LIKE '%$str_search%' OR age_category='$str_search'";
    $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
    $num_rows = mysqli_num_rows($result);
//    $row = mysqli_fetch_array($result);
//    if ($result) {
        echo '<div class="catalog" id="catal">';
        for ($i = 0; $i < $num_rows; $i++) {
            $row = mysqli_fetch_array($result);
            if ($row[7]==1){
                $img = "background: url('../img/favorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;";
            }
            else {
                $img = "background: url('../img/unfavorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;";
            }
            if ($row[6]==1){
                $img1 = "background: url('../img/basket.png') no-repeat; background-size: cover; width: 31px; height: 31px;";
            }
            else {
                $img1 = "background: url('../img/add_basket.png') no-repeat; background-size: cover; width: 31px; height: 31px;";
            }
            echo '<div class="elem">
            <img class="img" src="../img/'.$row[4].'" alt="" width="auto">
            <p class="text_prod1">'.$row[1].'</p>
            <p class="text_prod2">'.$row[3].'</p>
            <p class="text_prod1">'.$row[5].'+</p>
            <p class="text_prod3">$'.$row[2].'</p>
            <form id="form_fav" name="test" method="post" action="" onsubmit="return false;">
            <input class="favor" id="fav" name="favorit" type="submit" value="0" style="'.$img.'">
            <input class="add_basket" id="bask" name="basket" type="submit" value="0" style="'.$img1.'">
            </form>
            </div>';
        }
        echo '</div>';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="test.js"></script>';
}
?>

