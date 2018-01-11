<?php
session_start();
if (!isset($_SESSION['login'])) {
    include('404.php');
} else {
    ?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/template_styles.css">
        <link rel="stylesheet" type="text/css" href="css/components.css">
    </head>
    <body>
    <div class="b-site">
        <div class="b-header">
            <div class="container">
                <div class="top-menu clearfix">
                    <div class="logo">
                        <a href="index.php">
                            Volunteers
                        </a>
                    </div>

                    <div class="auth-reg">

                        <a href="#" class="btn-sandwich hidden-md-up">
                            <img src="images/header-sendwich.png" alt="#">
                        </a>

                        <a href="authorization.php" class="auth hidden-sm-down">
                            вход
                        </a>

                        <a href="registration.php" class="reg hidden-sm-down">
                            регистрация
                        </a>
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
        </div>

        <?php
        if ($_SESSION['auth'] = false) {
            include('404.php');
        }
        ?>
        <div class="b-profile">
            <div class="container">
                <div class="headline clearfix">
                    <div class="h1">
                        Профиль
                    </div>

                    <a href="edit-profile.php" class="edit">Редактировать</a>
                </div>

                <?php
                require_once('profile.class.php');
                $profile = new Profile();
                $profile->echoProfile();
                ?>

                <form action="profile.php" method="POST">
                    <button class="btn btn-submit pull-xs-right" name="logout" type="submit">Выйти</button>
                </form>
            </div>
        </div>
        <div class="b-footer">
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
        </div>
    </div>
    <script src="https://use.fontawesome.com/518e47326d.js"></script>
    <script src="js/main.js"></script>
    </body>
    </html>

    <?php
    require_once('profile.class.php');
    if (isset($_POST['logout'])) {
        $reg = new Profile();
        $reg->logout();
        header('Location: index.php');
    }
}
?>