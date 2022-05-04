<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/regist_style.css">
</head>
<body>
<div class="titles_div">
    <p class="lego_title">LEGO</p>
    <p class="reg" id="reg">авторизация</p>
</div>
<div class="regist">
    <form class="form" method="post" action="autoriz.php">
        <div class="inputs_div">
            <div class="row">
                <label for="login">Логин</label><br>
                <input type="text" name="login" id="login">
            </div>
            <div class="row">
                <label for="password">Пароль</label><br>
                <input type="password" name="password" id="password">
            </div>
        </div>
        <div class="buttons_div">
            <input type="submit" value="Войти">
            <a href="regist.php">Регистрация</a>
        </div>
    </form>
    <?php
    session_start();
    require ("../connect/connect_database.php");
    if (isset($_POST["login"]) && isset($_POST["password"])) {
        $login = $_POST["login"];
        $password = md5($_POST["password"]);
        $query = "SELECT * FROM users WHERE login = '$login' and password = '$password'";
        $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        $rows = mysqli_num_rows($result);
        if($login == '' || $password == ''){
            echo "<label style='position: absolute; top:380px; color: red;'>Заполните поля.</label>";

        } else {
            if ($rows != 0) {
                $row = mysqli_fetch_row($result);
                $_SESSION["role"] = $row[3];
                $_SESSION["user"] = $row[1];
                header("Location: main.php");
                exit;
            }
            else {
                echo "<label style='position: absolute; top:380px; color: red;'>Такого пользователя не существует.</label>";
            }
        }
    }
    ?>
</div>
</body>
</html>