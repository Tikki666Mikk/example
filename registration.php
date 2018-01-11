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
<div class="b-registration">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-xs-12 offset-xs-0">
                <form action="registration.php" class="reg-form" method="POST">
                    <div class="h2">
                        Регистрация
                    </div>

                    <div class="required-info">
                        Поля помеченные * обязательны для заполнения
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="input-group">
                                <label class="input-label">
                                    Логин *
                                </label>

                                <input required type="text" name="login" class="input-field">
                            </div>

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
                                    Пароль *
                                </label>

                                <input required type="text" name="password" class="input-field">
                            </div>

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

                            <button class="btn btn-submit pull-xs-right" name="send_reg" type="submit">Присоедениться</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
require_once ('registration.class.php');
if (isset($_POST['send_reg'])) {
    $reg = new Registration();
    $reg->registration_user();
    header('Location: index.php#success-registration');
}
