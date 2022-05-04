<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/regist_style.css">
</head>
<body>
<div class="titles_div">
    <p class="lego_title">LEGO</p>
    <p class="reg" id="reg">регистрация</p>
</div>
<div class="regist">
    <form class="form" method="post" action="regist.php">
        <div class="inputs_div">
            <div class="row">
                <label for="login">Логин</label><br>
                <input type="text" name="login" id="login">
            </div>
            <div class="row">
                <label for="password">Пароль</label><br>
                <input type="password" name="password" id="password">
            </div>
            <div class="row">
                <label for="repeat_password">Повторить пароль</label><br>
                <input type="password" name="repeat_password" id="repeat_password">
            </div>
        </div>
        <div class="buttons_div">
            <input type="submit" value="Зарегистрироваться">
            <a href="autoriz.php">Авторизация</a>
        </div>
    </form>
    <?php
    session_start();
    require ("../connect/connect_database.php");
    if (isset($_POST["login"])) {
        $login = $_POST["login"];
        $_SESSION["user"]=$login;
        $query = "SELECT * FROM users WHERE login = '$login'";
        $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
        $rows = mysqli_num_rows($result);
        if ($rows != 0) {
            echo "<label id='error' style='position: absolute; top:440px; color: red;'>Пользователь с таким логином уже существует.</label>";
        }

    }
    if (isset($_POST["password"])) {
        $login = $_POST["login"];
        $password = md5($_POST["password"]);
        $repeat_password = $_POST["repeat_password"];
        if ($login == '' || $password == '' || $repeat_password == ''){
            echo "<label id='error' style='position: absolute; top:440px; color: red;'>Заполните поля.</label>";
        } else{
            if ($password==md5($repeat_password)) {
                $query = "INSERT INTO users (login,password) VALUES ('$login','$password')";
                $result = mysqli_query($_SESSION["link"], $query) or die("Ошибка" . mysqli_error($_SESSION["link"]));
                if($result){
                    header('Location: main.php');
                    exit;
                    mysqli_free_result($result);
                } else {
                    echo "error database";
                }
            }
            else {
                echo "<label id='error' style='position: absolute; top:440px; color: red;'>Пароли не сходятся.</label>";
            }
        }
    }
    ?>
</div>
</body>
</html>