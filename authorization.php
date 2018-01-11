<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/template_styles.css">
    <link rel="stylesheet" type="text/css" href="css/components.css">
    <!--[if IE 9]>
    <![endif]-->
</head>
<body>
<div class="b-site" itemscope itemtype="http://schema.org/WebPage">
    <header class="b-header">
        <div class="container">
            <div class="top-menu clearfix">
                <div class="logo">
                    <a href="index.php">
                        Volunteers
                    </a>
                </div>

                <div class="auth-reg">
                    <?php
                    if (isset($_SESSION['login']) && $_SESSION['admin'] = false) {
                        echo '<a href="profile.php" class="auth">
                               ' . $_SESSION['login'] . '
                           </a>';
                    } elseif (isset($_SESSION['login']) && $_SESSION['admin'] = true) {
                        echo '<a href="admin.php" class="auth">
                               админка
                           </a><a href="profile.php" class="auth">
                               ' . $_SESSION['login'] . '
                           </a>';
                    } else {
                        echo '
                    <a href="#" class="btn-sandwich hidden-md-up">
                        <img src="images/header-sendwich.png" alt="#">
                    </a>
                    <a href="authorization.php" class="auth hidden-sm-down">
                        вход
                    </a>
                    <a href="registration.php" class="reg hidden-sm-down">
                        регистрация
                    </a>
                ';
                    }
                    ?>
                </div>
            </div>
    
            <div class="mobile-slide-menu auth-reg">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="authorization.php" class="auth">
                            вход
                        </a>
                    </div>
    
                    <div class="col-xs-6">
                        <a href="registration.php" class="reg">
                            регистрация
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
<div class="b-authorization">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 offset-xl-4 col-md-6 offset-md-3 col-xs-12 offset-xs-0">
                <form action="authorization.php" method="POST" class="reg-form">
                    <div class="h2">
                        Авторизация
                    </div>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <label class="input-label">
                                    Логин
                                </label>

                                <input type="text" name="login" class="input-field">
                            </div>

                            <div class="input-group">
                                <label class="input-label">
                                    Пароль
                                </label>

                                <input type="password" name="password" class="input-field">
                            </div>

                            <button class="btn btn-submit pull-xs-right" type="submit" name="send_auth">
                                Войти
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="b-popup">
    <a href="#" class="popup success-reg">
        <span class="close-popup">x</span>
        Вы успешно зарегистрировались
    </a>

    <a href="#" class="popup success-auth">
        <span class="close-popup">x</span>
        Вы вошли в аккаунт
    </a>

    <a href="#" class="popup unsuccess-auth">
        <span class="close-popup">x</span>
        Данные введены не верно
    </a>

    <a href="#" class="popup success-update">
        <span class="close-popup">x</span>
        Вы успешно изменили данные
    </a>

    <a href="#" class="popup success-logout">
        <span class="close-popup">x</span>
        Вы успешно изменили данные
    </a>

    <a href="#" class="popup login-exist">
        <span class="close-popup">x</span>
        Логин уже существует
    </a>
    <div class="overlay">
    </div>
</div>
<footer class="b-footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="logo">
                    Volunteers
                </div>

                <div class="social">
                    <a href="#" class="soc-icon fa fa-twitter">
                    </a>

                    <a href="#" class="soc-icon fa fa-vk">
                    </a>

                    <a href="#" class="soc-icon fa fa-whatsapp">
                    </a>

                    <a href="#" class="soc-icon fa fa-facebook">
                    </a>
                </div>
            </div>

            <div class="col-xs-12 col-md-6">
                <div class="h2">
                    Контакты
                </div>

                <ul>
                    <li>
                        Email: example@email.com
                    </li>

                    <li>
                        Телефон: 8-800-555-35-35
                    </li>

                    <li>
                        Адрес: г. Москва ул. Пушкина д. 12
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="bottom-line">
        <div class="container">
            <div class="copyright">
                &copy; Конюхов Данил, 2017 г.
            </div>
        </div>
    </div>
</footer>
</div>
<script src="js/main.js"></script>
<!--[if IE 9]>
<![endif]-->
</body>
</html>

<?php
require_once('authorization.class.php');
if (isset($_POST['send_auth'])) {
    $login = $_POST['login'];
    $password = md5(md5($_POST['password']));
    $reg = new Authorization();
    $reg->authorization_user($login, $password);
}