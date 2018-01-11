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
<div class="b-404">
    <div class="container">
        <div class="h1">
            404
        </div>
        <div class="desscription">
            Данная страница не существует либо не доступна
        </div>

        <a href="index.php" class="btn">
            Вернуться
        </a>
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