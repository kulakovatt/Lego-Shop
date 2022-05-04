<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/main_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="ajax.js"></script>
</head>
<body>
<input type="checkbox" id="nav-toggle" hidden>
<nav class="nav">
<label for="nav-toggle" class="nav-toggle" onclick></label>
    <h2 class="logo">
        <a href="main.php"><img src="../img/logo_lego.jpg" alt="" width="35%"></a>
    </h2>
    <ul>
        <li><?php
                session_start();
                if($_SESSION["role"] == 1){
                    echo '<a href="private_officeA.php">Личный кабинет</a>';
                } else {
                    echo '<a href="private_officeU.php">Личный кабинет</a>';
                }
            ?>
        <li><a href="#catalog">Каталог</a>
        <li><a href="contacts.php">Контакты</a>
        <li><a href="about_us.php">О нас</a>
    </ul>
    <img src="../img/superman.png" alt="" style="margin-left: 20px;" width="70%">
</nav>
<div class="main">
<h2 class="zag">Lego Shop</h2>
    <button class="btn_1"><a href="#catalog">Перейти в каталог →</a></button>
</div>
<div id="catalog" class="map">
    <form class="form_search" id="formx" method="post" action="" onsubmit="return false;">
        <label for="search" style="margin-left: 30px; font-family: 'Cera Pro'; color: white">Поиск: </label>
        <input id="search_box" type="search" name="search">
        <button type="submit" class="search" onclick="call()"><img src="../img/search.png"></button>
    </form>
    <div class="filters_div">
        <form class="filter" id="formx-1" method="post" action="" onsubmit="return false;">
            <label>Сортировка по: </label>
            <div class="row">
                <input id="price_up" type="radio" name="sort" value="1">
                <label for="price_up">возрастанию цены</label>
            </div>
            <div class="row">
                <input id="price_down" type="radio" name="sort" value="0">
                <label for="price_down">убыванию цены</label>
            </div>
            <button type="submit" class="button_filter sort" onclick="sortirovka()">Сортировать</button>
        </form>

        <form class="filter" id="formx-2" method="post" action="" onsubmit="return false;">
            <label>Фильтрация по: </label>
            <div class="row">
                <input type="checkbox" name="choiceAge" id="age">
                <label for="age">Возрасту: от</label>
                <input id="beforeAge" type="number" min="0" value="0" name="ageO" placeholder="От">
                <label>до</label>
                <input id="afterAge" type="number" min="0" value="0" name="ageD" placeholder="До">
            </div>
            <div class="row">
                <input type="checkbox" name="choiceTheme" id="theme" >
                <label for="theme">Тематике:</label>
                <?php
                require ("../connect/connect_database.php");
                $query = 'SELECT * FROM products';
                $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
                $row = mysqli_fetch_array($result);
                echo "<select id='them' name='theme' disabled>";
                do//открываем цикл
                {
                    $theme = $row[3];
                    printf ("<option value='$row[3]'>%s</option>",$theme);
                }
                while($row = mysqli_fetch_array($result));
                echo "</select><br>";
                ?>
            </div>
            <button type="submit" class="button_filter filt" style="margin-left: 30px;" onclick="filtration()">Показать результаты</button>
        </form>
    </div>
    <div id="results"></div>
    <div class="catalog" id="catal">

            <?php
            require ("../connect/connect_database.php");
            $query2 = 'SELECT id_user FROM users WHERE login="'.$_SESSION["user"].'"';
            $result2 = mysqli_query($_SESSION["link"], $query2) or die("Ошибка" . mysqli_error($_SESSION["link"]));
            $row2 = mysqli_fetch_array($result2);
            $_SESSION["user_id"] = $row2[0];
            $query = 'SELECT * FROM products';
            $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
            $_SESSION["num_rows"] = mysqli_num_rows($result);
            for ($i = 0; $i < $_SESSION["num_rows"]; $i++){
                $row = mysqli_fetch_array($result);
                $queryPF = 'SELECT * FROM favorite WHERE id_user="'.$row2[0].'" AND id_product="'.$row[0].'"';
                $resultPF = mysqli_query($_SESSION["link"], $queryPF) or die("Ошибка" . mysqli_error($_SESSION["link"]));
                $num_rowPF = mysqli_num_rows($resultPF);
                $queryPB = 'SELECT * FROM bag WHERE id_user="'.$row2[0].'" AND id_product="'.$row[0].'"';
                $resultPB = mysqli_query($_SESSION["link"], $queryPB) or die("Ошибка" . mysqli_error($_SESSION["link"]));
                $num_rowPB = mysqli_num_rows($resultPB);
                if ($num_rowPF != 0){
                    $_SESSION["val_input_fav"] = 1;
                    $img = "background: url('../img/favorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;";
                }
                else {
                    $_SESSION["val_input_fav"] = 0;
                    $img = "background: url('../img/unfavorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;";
                }
                if ($num_rowPB != 0){
                    $_SESSION["val_input_bas"] = 1;
                    $img1 = "background: url('../img/basket.png') no-repeat; background-size: cover; width: 31px; height: 31px;";
                }
                else {
                    $_SESSION["val_input_bas"] = 0;
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
                <input class="favor" id="fav" name="favorit" type="submit" value="'.$_SESSION["val_input_fav"].'" style="'.$img.'">
                <input class="add_basket" id="bask" name="basket" type="submit" value="'.$_SESSION["val_input_bas"].'" style="'.$img1.'">
                </form>
            </div>
            </div>';
            }

            ?>
    </div>
</div>
<script>
let div = document.getElementsByClassName("elem");

for(let i = 0; i < div.length; i++){
    div[i].setAttribute("id", "_" + i);
}

$('#theme').on('change', function disable(){
    if($('#theme').is(':checked')){
        $('#them')[0].disabled = false;
    } else {
        $('#them')[0].disabled = true;
    }
})

$('.favor').on('click', function favorite() {
    var messages = $(this).closest('.elem')[0].innerText;
    console.log(messages);
    console.log($(this));
    console.log($(this)[0].defaultValue);

    if($(this)[0].defaultValue == 0){
        $(this)[0].setAttribute('style', "background: url('../img/favorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;");
        $(this)[0].defaultValue = 1;
    } else if ($(this)[0].defaultValue == 1) {
        $(this)[0].setAttribute('style', "background: url('../img/unfavorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;");
        $(this)[0].defaultValue = 0;
    }
    var val = $(this)[0].defaultValue;

        // var xmlhttp = new XMLHttpRequest();
        //
        //
        // xmlhttp.onreadystatechange = function() {
        //     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        //         alert(xmlhttp.responseText);
        //     }
        // }
        //
        // xmlhttp.open("POST", "designTest.php", true);
        // xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        // xmlhttp.send("message=" + messages + "&val=" + val);
    $.ajax({
        type: 'POST',
        url: 'favorite.php',
        data: messages + val,
        success: $.get('favorite.php', {message: messages, val:val}, function(data) {
        // alert('записан: '+data);
            })
    });
});


$('.add_basket').on('click', function add_basket() {
    var messages = $(this).closest('.elem')[0].innerText;
    console.log(messages);
    console.log($(this));
    console.log($(this)[0].defaultValue);

    if($(this)[0].defaultValue == 0){
        $(this)[0].setAttribute('style', "background: url('../img/basket.png') no-repeat; background-size: cover; width: 31px; height: 31px;");
        $(this)[0].defaultValue = 1;
    } else if ($(this)[0].defaultValue == 1) {
        $(this)[0].setAttribute('style', "background: url('../img/add_basket.png') no-repeat; background-size: cover; width: 31px; height: 31px;");
        $(this)[0].defaultValue = 0;
    }
    var val = $(this)[0].defaultValue;
    $.ajax({
        type: 'POST',
        url: 'basket.php',
        data: messages + val,
        success: $.get('basket.php', {message: messages, val:val}, function(data) {
            // alert('записан: '+data);
        })
    });
});

</script>
</body>
</html>