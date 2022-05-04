<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/office_A.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="ajax.js"></script>
</head>
<body>
<div class="main">
    <div class="container_hello">
        <button class="button_back"><a href="main.php">← Назад</a></button>
        <div class="hello">
            <?php
            session_start();
            echo "<p class='p_hello'>Добро пожаловать,<span class='p_hello' style='color: #4cd137'>".$_SESSION["user"]."</span></p>";
            ?>
            <p class="small_p">Хорошего дня!</p>
        </div>
    </div>

    <div class="container_buttons">
        <button class="btn_1"><a href="autoriz.php">Выйти</a></button>
        <button class="btn_1"><a href="#catal">Избранное</a></button>
        <button class="btn_1"><a href="#basket">Корзина</a></button>
        <button class="btn_1"><a href="#order">Заказы</a></button>
    </div>

        <div class="catalog" id="catal">
            <h2>Избранное</h2>
            <div class="catalog_container">


    <?php
    require ("../connect/connect_database.php");
    $query2 = 'SELECT id_user FROM users WHERE login="'.$_SESSION["user"].'"';
    $result2 = mysqli_query($_SESSION["link"], $query2) or die("Ошибка" . mysqli_error($_SESSION["link"]));
    $row2 = mysqli_fetch_array($result2);

    $query1 = 'SELECT * FROM products INNER JOIN favorite ON products.id_product = favorite.id_product WHERE id_user="'.$row2[0].'"';
    $result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));
    $_SESSION["num_rows"] = mysqli_num_rows($result1);

    for ($i = 0; $i < $_SESSION["num_rows"]; $i++){
        $row = mysqli_fetch_array($result1);
        $queryPF = 'SELECT * FROM favorite WHERE id_user="'.$row2[0].'" AND id_product="'.$row[0].'"';
        $resultPF = mysqli_query($_SESSION["link"], $queryPF) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        $num_rowPF = mysqli_num_rows($resultPF);
        if ($num_rowPF != 0){
            $_SESSION["val_input_fav"] = 1;
            $img = "background: url('../img/favorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;";
        }
        else {
            $_SESSION["val_input_fav"] = 0;
            $img = "background: url('../img/unfavorite.png') no-repeat; background-size: cover; width: 29px; height: 29px;";
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
                    </form>
                </div>
                </div>';
    }
    ?>
            </div>
        </div>

        <div class="catalog" id="basket">
        <h2>Корзина</h2>
            <?php
            require ("../connect/connect_database.php");
            $query1 = 'SELECT * FROM products INNER JOIN bag ON products.id_product = bag.id_product WHERE id_user="'.$_SESSION["user_id"].'" AND bag.order_id=0';
            $result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));
            $_SESSION["num_rows"] = mysqli_num_rows($result1);
            for ($i = 0; $i < $_SESSION["num_rows"]; $i++){
                $row = mysqli_fetch_array($result1);
                $query2 = 'SELECT count FROM bag WHERE id_product="'.$row[0].'" AND id_user="'.$_SESSION["user_id"].'"';
                $result2 = mysqli_query($_SESSION["link"], $query2) or die("Ошибка" . mysqli_error($_SESSION["link"]));
                $row1 = mysqli_fetch_array($result2);

                echo '<div class="elem_bag">
                <img class="img" src="../img/'.$row[4].'" alt="" width="auto">
                <div class="col">
                    <p class="text_prod1">'.$row[1].'</p>
                    <p class="text_prod2">'.$row[3].'</p>
                </div>
                <p class="text_prod1">'.$row[5].'+</p>
                <p class="text_prod3">$'.$row[2].'</p>
               
                <div class="div_count">
                    <input type="submit" name="count_minus>" class="icon count_minus" value="−">
                    <input class="count" type="number" step="1" max="'.$row[6].'" value="'.$row1[0].'" readonly>
                    <input type="submit" name="count_plus" class="icon count_plus" value="+">
                </div>
                <div class="common_price">$'.$row[2]*$row1[0].'</div>
                
                <form id="form_fav" name="test" method="post" action="" onsubmit="return false;">
                    <input class="delete_basket" name="basket" type="submit" value="0">
                </form>
                </div>';
            }
            if($_SESSION["num_rows"] != 0){
            echo '<form id="form_order" name="add_ord" method="post" action="form_order.php">
                <input name="add_order" type="submit">
            </form>';}
            ?>

        </div>
        <div class="catalog" id="order">
            <h2>Заказы</h2>
            <?php
            require ("../connect/connect_database.php");
            $query1 = 'SELECT * FROM products INNER JOIN bag ON products.id_product = bag.id_product WHERE id_user="'.$_SESSION["user_id"].'" AND bag.order_id!=0';
            $result1 = mysqli_query($_SESSION["link"], $query1) or die("Ошибка" . mysqli_error($_SESSION["link"]));
            $_SESSION["num_rows"] = mysqli_num_rows($result1);
            for ($i = 0; $i < $_SESSION["num_rows"]; $i++){
                $row = mysqli_fetch_array($result1);
                $query2 = 'SELECT count FROM bag WHERE id_product="'.$row[0].'" AND id_user="'.$_SESSION["user_id"].'"';
                $result2 = mysqli_query($_SESSION["link"], $query2) or die("Ошибка" . mysqli_error($_SESSION["link"]));
                $row1 = mysqli_fetch_array($result2);

                echo '<div class="elem_bag">
                <img class="img" src="../img/'.$row[4].'" alt="" width="auto">
                <div class="col">
                    <p class="text_prod1">'.$row[1].'</p>
                    <p class="text_prod2">'.$row[3].'</p>
                </div>
                <p class="text_prod1">'.$row[5].'+</p>
                <p class="text_prod3">$'.$row[2].'</p>
               
                <div class="div_count">
                    
                    <input class="count" type="number" step="1" max="'.$row[6].'" value="'.$row1[0].'" readonly>
                    
                </div>
                <div class="text_prod3">$'.$row[2]*$row1[0].'</div>
                
                <form id="form_fav" name="test" method="post" action="" onsubmit="return false;">
                    <input class="delete_order" name="order_del" type="submit" value="0">
                </form>
                </div>';
            }
//            if($_SESSION["num_rows"] != 0){
//                $query4 = 'SELECT order_id FROM order_prod WHERE user_id="'.$_SESSION["user_id"].'"';
//                $result4 = mysqli_query($_SESSION["link"], $query4) or die("Ошибка" . mysqli_error($_SESSION["link"]));
//                $rowOrd = mysqli_fetch_array($result4);
//                $query6 = "DELETE FROM bag WHERE order_id='".$rowOrd[0]."' AND id_user='".$_SESSION["user_id"]."' AND order_id!=0";
//                $result6 = mysqli_query($_SESSION["link"], $query6) or die("Ошибка" . mysqli_error($_SESSION["link"]));
//            }
            ?>
        </div>
    <script>
        let div = document.getElementsByClassName("elem");

        for(let i = 0; i < div.length; i++){
            div[i].setAttribute("id", "_" + i);
        }

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
            $.ajax({
                type: 'POST',
                url: 'favorite.php',
                data: messages + val,
                success: $.get('favorite.php', {message: messages, val:val}, function(data) {
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
                })
            });
        });

        $('.delete_basket').on('click', function delete_basket() {
            var messages = $(this).closest('.elem_bag')[0].innerText;
            console.log(messages);
            console.log($(this));
            console.log($(this)[0].defaultValue);

            $.ajax({
                type: 'POST',
                url: 'delete_basket.php',
                data: messages,
                success: $.get('delete_basket.php', {message: messages}, function(data) {
                })
            });
            $(this).closest('.elem_bag').remove();
        });

        $('.delete_order').on('click', function delete_basket() {
            var messages = $(this).closest('.elem_bag')[0].innerText;
            console.log(messages);
            console.log($(this));
            console.log($(this)[0].defaultValue);

            $.ajax({
                type: 'POST',
                url: 'delete_order.php',
                data: messages,
                success: $.get('delete_order.php', {message: messages}, function(data) {
                })
            });
            $(this).closest('.elem_bag').remove();
        });

        $('.count_minus').on('click', function count_minus() {
            var messages = $(this).parent().find('.count')[0].defaultValue;
            if($(this).parent().find('.count')[0].defaultValue > 1){
                $(this).parent().find('.count')[0].defaultValue = Number(messages) - 1;
                $(this).parent().parent().find('.common_price')[0].innerText = '$' + (Number($(this).parent().parent().find('.text_prod3')[0].innerText.slice(1)) * Number($(this).parent().find('.count')[0].defaultValue)).toFixed(2);
            } else {
                $(this).parent().find('.count')[0].defaultValue = 1;
                $(this).parent().parent().find('.common_price')[0].innerText = '$' + (Number($(this).parent().parent().find('.text_prod3')[0].innerText.slice(1)) * Number($(this).parent().find('.count')[0].defaultValue)).toFixed(2);
            }
            messages = $(this).parent().find('.count')[0].defaultValue;
            var name = $(this).parent().parent()[0].innerText;
            $.ajax({
                type: 'POST',
                url: 'update_count.php',
                data: messages + name,
                success: $.get('update_count.php', {message: messages, name: name}, function(data) {
                })
            });
        });

        $('.count_plus').on('click', function count_plus() {
            var messages = $(this).parent().find('.count')[0].defaultValue;
            if($(this).parent().find('.count')[0].defaultValue < $(this).parent().find('.count')[0].max){
                $(this).parent().find('.count')[0].defaultValue = Number(messages) + 1;
                $(this).parent().parent().find('.common_price')[0].innerText = '$' + (Number($(this).parent().parent().find('.text_prod3')[0].innerText.slice(1)) * Number($(this).parent().find('.count')[0].defaultValue)).toFixed(2);
            }

            messages = $(this).parent().find('.count')[0].defaultValue;
            var name = $(this).parent().parent()[0].innerText;
            let max_value = $(this).parent().find('.count')[0].max;
            $.ajax({
                type: 'POST',
                url: 'update_count.php',
                data: messages + name,
                success: $.get('update_count.php', {message: messages, name: name}, function(data) {
                    if(data == max_value){
                        alert("Больше такого товара нет на складе.");
                    }
                })
            });
        });
    </script>
</body>
</html>