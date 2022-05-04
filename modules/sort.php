<?php
session_start();
require ("../connect/connect_database.php");
if(isset($_POST["sort"])){
    $sort = $_POST["sort"];
    $query_down = "SELECT * FROM products ORDER BY price_product DESC";
    $query_up = "SELECT * FROM products ORDER BY price_product ASC";
    $result_up = mysqli_query($_SESSION["link"], $query_up) or die("Ошибка" . mysqli_error($_SESSION["link"]));
    $result_down = mysqli_query($_SESSION["link"], $query_down) or die("Ошибка" . mysqli_error($_SESSION["link"]));
    $num_rows_up = mysqli_num_rows($result_up);
    $num_rows_down = mysqli_num_rows($result_down);
    if($sort == 1){
    echo '<div class="catalog" id="catal">';
    for ($i = 0; $i < $num_rows_up; $i++) {
        $row = mysqli_fetch_array($result_up);
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
            <div class="elem_info">
            <p class="text_prod1">'.$row[1].'</p>
            <p class="text_prod2">'.$row[3].'</p>
            <p class="text_prod1">'.$row[5].'+</p>
            <p class="text_prod3">$'.$row[2].'</p>
            <form id="form_fav" name="test" method="post" action="" onsubmit="return false;">
            <input class="favor" id="fav" name="favorit" type="submit" value="0" style="'.$img.'">
            <input class="add_basket" id="bask" name="basket" type="submit" value="0" style="'.$img1.'">
            </form>
            </div>
            </div>';
    }
    echo '</div>';
    } else if ($sort == 0){
        echo '<div class="catalog" id="catal">';
        for ($i = 0; $i < $num_rows_down; $i++) {
            $row = mysqli_fetch_array($result_down);
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
            <div class="elem_info">
            <p class="text_prod1">'.$row[1].'</p>
            <p class="text_prod2">'.$row[3].'</p>
            <p class="text_prod1">'.$row[5].'+</p>
            <p class="text_prod3">$'.$row[2].'</p>
            <form id="form_fav" name="test" method="post" action="" onsubmit="return false;">
            <input class="favor" id="fav" name="favorit" type="submit" value="0" style="'.$img.'">
            <input class="add_basket" id="bask" name="basket" type="submit" value="0" style="'.$img1.'">
            </form>
            </div>
            </div>';
        }
        echo '</div>';
    }
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="test.js"></script>';
}
?>

