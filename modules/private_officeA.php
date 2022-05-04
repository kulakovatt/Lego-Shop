<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/office_A.css">
</head>
<body>
<div class="main">
    <div class="head_div">
        <div class="hello">
            <?php
            session_start();
            echo "<p class='p_hello'>Добро пожаловать,<span class='p_hello' style='color: #4cd137'>".$_SESSION["user"]."</span></p>";
            ?>
            <p class="small_p">Хорошего дня на работе!</p>
        </div>

        <button class="btn_1"><a href="autoriz.php">Выйти</a></button>
    </div>
<div class="edit_form">
    <form method="post" action="private_officeA.php" class="form">
        <div>
            <label class="label_m">Добавить товар</label><hr width="150px">
            <input name="name" type="text" placeholder="Наименование">
            <input name="price" type="text" placeholder="Цена">
            <input name="theme" type="text" placeholder="Тематика">
            <input name="photo" type="file" placeholder="Фото">
            <input name="age" type="text" placeholder="Возрастная категория">
        </div>
        <input type="submit" value="Добавить">
    </form>
    <?php
    require ("../connect/connect_database.php");
    if (isset($_POST["name"])) {
        $name = $_POST["name"];
        $price = $_POST["price"];
        $theme = $_POST["theme"];
        $photo = $_POST["photo"];
        $age = $_POST["age"];
        $query = "INSERT INTO products (name_product,price_product,theme_product,photo_product,age_category) VALUES ('$name',$price,'$theme','$photo','$age')";
        $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        if ($result) {
            echo "<label style='position: absolute; top:540px; color: greenyellow;'>Добавлено</label>";
        }
    }
    ?>
    <form method="post" action="private_officeA.php" class="form">
        <div>
            <label class="label_m">Изменить товар</label><hr width="150px">
            <?php
            require ("../connect/connect_database.php");
            $query = 'SELECT * FROM products';
            $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
            $row = mysqli_fetch_array($result);
            echo "<select name='products'>";
            do//открываем цикл
            {
                $name = $row[1];
                printf ("<option value='$row[0]'>%s</option>",$name);
            }
            while($row = mysqli_fetch_array($result));
            echo "</select>";
            ?>
            <input name="price1" type="text" placeholder="Цена">
            <input name="theme1" type="text" placeholder="Тематика">
            <input name="photo1" type="file" placeholder="Фото">
            <input name="age1" type="text" placeholder="Возрастная категория">
        </div>
        <input type="submit" value="Изменить">
    </form>
    <?php
    require ("../connect/connect_database.php");
    if (isset($_POST["price1"])) {
        $select = $_POST["products"];
        $price = $_POST["price1"];
        $theme = $_POST["theme1"];
        $photo = $_POST["photo1"];
        $age = $_POST["age1"];
        $query = "UPDATE products SET price_product='$price',theme_product='$theme',photo_product='$photo',age_category='$age' WHERE id_product='$select'";
        $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        if ($result) {
            echo "<label style='position: absolute; top:540px; color: greenyellow;'>Изменено</label>";
        }
    }
    ?>
    <form method="post" action="private_officeA.php" class="form">
        <div>
            <label class="label_m">Удалить товар</label><hr width="135px">
            <?php
            require ("../connect/connect_database.php");
            $query = 'SELECT * FROM products';
            $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
            $row = mysqli_fetch_array($result);
            echo "<select name='products'>";
            do//открываем цикл
            {
                $name = $row[1];
                printf ("<option value='$row[0]'>%s</option>",$name);
            }
            while($row = mysqli_fetch_array($result));
            echo "</select>";
            ?>
        </div>
        <input type="submit" value="Удалить">
    </form>
    <?php
    require ("../connect/connect_database.php");
    if (isset($_POST["products"])) {
        $select1 = $_POST["products"];
        $query = "DELETE FROM products WHERE id_product='$select1'";
        $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        if ($result) {
            echo "<label style='position: absolute; top:540px; color: greenyellow;'>Удалено</label>";
        }
    }
    ?>
</div>
</div>
</body>
</html>