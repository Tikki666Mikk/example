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
        <?php
        if ($_SESSION['auth'] = false) {
            include('404.php');
        }
        ?>
        <div class="b-admin">
            <div class="profiles">
                <div class="container">
                    <div class="h1">
                        Админ - панель
                    </div>
                    <div class="h2">
                        Профили
                    </div>

                    <div class="slider-container">
                        <div class="swiper-container js-admin-slider">
                            <div class="swiper-wrapper">
                                <?php
                                require_once('admin.class.php');
                                $news = new Admin();
                                $news->echoAdminProfiles();
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

                <div class="admin-edit-profile popup edit-profile-popup">
                    <form action="admin.php" class="reg-form" method="POST">
                        <input type="hidden" name="login" class="set-login">
                        <div class="h2">
                            Редактирование профиля
                        </div>

                        <div class="required-info">
                            Поля помеченные * обязательны для заполнения
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <label class="input-label">
                                        Фамилия *
                                    </label>

                                    <input required type="text" name="lastName" class="input-field">
                                </div>

                                <div class="input-group">
                                    <label class="input-label">
                                        Отчество
                                    </label>

                                    <input type="text" name="patronymic" class="input-field">
                                </div>

                                <div class="input-group">
                                    <label class="input-label">
                                        Телефон *
                                    </label>

                                    <input required type="text" name="phone" class="input-field phone-field">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <label class="input-label">
                                        Имя *
                                    </label>

                                    <input required type="text" name="firstName" class="input-field">
                                </div>

                                <div class="input-group">
                                    <label class="input-label">
                                        Email *
                                    </label>

                                    <input required type="text" name="email" class="input-field">
                                </div>

                                <div class="input-group">
                                    <label class="input-label">
                                        Направление
                                    </label>

                                    <select name="specializations" id="#" class="input-field">
                                        <?php
                                        require_once('specializations.class.php');
                                        $specializations_head = new Specializations();
                                        $specializations_head->echoSpecializationsName();
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="input-group">
                                    <label class="input-label">
                                        О себе
                                    </label>

                                    <textarea name="about" class="input-field"></textarea>
                                </div>

                                <button class="btn btn-submit pull-xs-right" name="admin_send_update" type="submit">
                                    Изменить
                                </button>
                            </div>
                        </div>
                    </form>

                    <a href="#" class="close-popup">x</a>
                </div>
            </div>

            <div class="news clearfix parent">
                <div class="container">
                    <div class="clearfix headline-news1">
                        <div class="h2">
                            Новости
                        </div>

                        <a href="#" class="js-add-news add-news">
                            <i class="fa fa-plus-square-o add-record" aria-hidden="true"></i>
                        </a>
                    </div>

                    <div class="swiper-container news-swiper js-news-swiper">
                        <div class="swiper-wrapper">
                            <?php
                            require_once('admin.class.php');
                            $news = new Admin();
                            $news->echoAdminNews();
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

                <form method="POST" enctype="multipart/form-data" action="admin.php"
                      class="popup popup-news popup-add-record">
                    <a href="#" class="close-popup">x</a>

                    <div class="form-group">
                        <label>
                            Выберите изображение
                        </label>
                        <input name="add_img_news" type="file" class="img-news input-field">
                    </div>

                    <div class="form-group">
                        <label>
                            Текст новости
                        </label>
                        <textarea name="text-news" type="text" class="text-news input-field"></textarea>
                    </div>

                    <div class="form-group">
                        <label>
                            Дата
                        </label>
                        <input type="date" class="input-field date-news" name="date-news">
                    </div>

                    <button class="btn send-form" name="admin_add_news">Добавить</button>
                </form>

                <div class="admin-edit-news popup edit-news-popup">
                    <form action="admin.php" enctype="multipart/form-data" class="update-news" method="POST">
                        <input type="hidden" name="id" class="set-id-news">
                        <div class="h2">
                            Редактирование новости
                        </div>

                        <a href="#" class="close-popup">x</a>

                        <div class="form-group">
                            <label>
                                Выберите изображение
                            </label>
                            <input name="edit_img_news" type="file" class="img-news input-field">
                        </div>

                        <div class="form-group">
                            <label>
                                Текст новости
                            </label>
                            <textarea name="text-news" type="text" class="text-news input-field"></textarea>
                        </div>

                        <div class="form-group">
                            <label>
                                Дата
                            </label>
                            <input type="date" class="input-field date-news" name="date-news">
                        </div>

                        <button class="btn send-form" name="admin_edit_news">Изменить</button>
                    </form>

                    <a href="#" class="close-popup">x</a>
                </div>
            </div>

            <div class="events clearfix parent">
                <div class="container">
                    <div class="clearfix headline-events">
                        <div class="h2">
                            События
                        </div>

                        <a href="#" class="js-add-events add-events">
                            <i class="fa fa-plus-square-o add-record" aria-hidden="true"></i>
                        </a>
                    </div>

                    <div class="slider-container">
                        <div class="swiper-container events-swiper js-events-swiper">
                            <div class="swiper-wrapper">
                                <?php
                                require_once('admin.class.php');
                                $news = new Admin();
                                $news->echoAdminEvents();
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

                <form method="POST" enctype="multipart/form-data" action="admin.php"
                      class="popup popup-events popup-add-record">
                    <a href="#" class="close-popup">x</a>

                    <div class="form-group">
                        <label>
                            Выберите изображение
                        </label>
                        <input name="add_img_events" type="file" class="img-events input-field">
                    </div>

                    <div class="form-group">
                        <label>
                            Текст новости
                        </label>
                        <textarea name="text-events" type="text" class="text-events input-field"></textarea>
                    </div>

                    <div class="form-group">
                        <label>
                            Дата
                        </label>
                        <input type="date" class="input-field date-events" name="date-events">
                    </div>

                    <button class="btn send-form" name="admin_add_events">Добавить</button>
                </form>

                <div class="admin-edit-events popup edit-events-popup">
                    <form action="admin.php" enctype="multipart/form-data" class="update-events" method="POST">
                        <input type="hidden" name="id" class="set-id-events">
                        <div class="h2">
                            Редактирование новости
                        </div>

                        <a href="#" class="close-popup">x</a>

                        <div class="form-group">
                            <label>
                                Выберите изображение
                            </label>
                            <input name="edit_img_events" type="file" class="img-events input-field">
                        </div>

                        <div class="form-group">
                            <label>
                                Текст новости
                            </label>
                            <textarea name="text-events" type="text" class="text-events input-field"></textarea>
                        </div>

                        <div class="form-group">
                            <label>
                                Дата
                            </label>
                            <input type="date" class="input-field date-events" name="date-events">
                        </div>

                        <button class="btn send-form" name="admin_edit_events">Изменить</button>
                    </form>

                    <a href="#" class="close-popup">x</a>
                </div>
            </div>

            <form action="profile.php" method="POST">
                <button class="btn btn-submit pull-xs-right" name="logout" type="submit">Выйти</button>
            </form>
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

    <?php
    require_once('admin.class.php');
    if (isset($_POST['admin_send_update'])) {
        $reg = new Admin();
        $reg->update_user();
        header('Location: admin.php#success-update');
    }
    if (isset($_POST['admin_remove_profile'])) {
        $reg = new Admin();
        $reg->remove_user();
        header('Location: admin.php#success-update');
    }
    if (isset($_POST['admin_edit_news'])) {
        $reg = new Admin();
        $reg->update_news();
        header('Location: admin.php#success-update');
    }
    if (isset($_POST['admin_remove_news'])) {
        $reg = new Admin();
        $reg->remove_news();
        header('Location: admin.php#success-update');
    }
    if (isset($_POST['admin_add_news'])) {
        $reg = new Admin();
        $reg->add_news();
        header('Location: admin.php#success-update');
    }
    if (isset($_POST['admin_edit_events'])) {
        $reg = new Admin();
        $reg->update_event();
        header('Location: admin.php#success-update');
    }
    if (isset($_POST['admin_remove_events'])) {
        $reg = new Admin();
        $reg->remove_events();
        header('Location: admin.php#success-update');
    }
    if (isset($_POST['admin_add_events'])) {
        $reg = new Admin();
        $reg->add_events();
        header('Location: admin.php#success-update');
    }

    require_once('profile.class.php');
    if (isset($_POST['logout'])) {
        $reg = new Profile();
        $reg->logout();
        header('Location: index.php');
    }
}