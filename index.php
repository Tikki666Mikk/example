<?php
session_start();
$_SESSION['auth'] = false;
?>
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
<div class="b-about-us">
    <div class="container">
        <div class="h1">
            О нас
        </div>

        <div class="text">
            Lorem Ipsum – это текст-“рыба”, часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной
            “рыбой” для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую
            коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только
            успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации.
        </div>
    </div>
</div>
<div class="b-news parent">
    <div class="container">
        <div class="h1">
            Новости
        </div>

        <div class="swiper-container news-swiper js-news-swiper">
            <div class="swiper-wrapper">
                <?php
                require_once('news.class.php');
                $news = new News();
                $news->echoNews();
                ?>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="overlay">
    </div>

    <div class="popup popup-detail">
        <a href="#" class="close-popup">x</a>

        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="text">
                </div>

                <div class="bottom-line clearfix">
                    <div class="date">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xs-12">
                <div class="img">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="b-events parent">
    <div class="container">
        <div class="h1">
            События
        </div>

        <div class="slider-container">
            <div class="swiper-container events-swiper js-events-swiper">
                <div class="swiper-wrapper">
                    <?php
                    require_once('events.class..php');
                    $news = new Events();
                    $news->echoEvents();
                    ?>
                </div>
            </div>

            <div class="swiper-button-prev left-arrow arrow">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 7 27 30" color="#000">
                    <path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z" fill="#f3d231"/>
                </svg>
            </div>
            <div class="swiper-button-next right-arrow arrow">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 7 27 30" color="#000">
                    <path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z" fill="#f3d231"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="overlay">
    </div>

    <div class="popup popup-detail">
        <a href="#" class="close-popup">x</a>

        <div class="row">
            <div class="col-lg-6 col-xs-12">
                <div class="text">
                </div>

                <div class="bottom-line clearfix">
                    <div class="date">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xs-12">
                <div class="img">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="b-join-us">
    <div class="container">
        <div class="h1">
            Стань участником нашего движения
        </div>

        <div class="watchword">
            Сделай мир лучше
        </div>

        <a href="specialization.php" class="join">
            Направления
        </a>
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