<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Академия</title>
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
<div class="b-specialization">
    <div class="container">
        <div class="headline">
            <div class="h1">
                Направления
            </div>

            <div class="text">
                Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является
                стандартной "рыбой" для текстов на латинице с начала XVI века. В то время некий безымянный печатник
                создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов.
            </div>
        </div>

        <?php
        require_once('specializations.class.php');
        $specializations = new Specializations();
        $specializations->echoSpecializations();
        ?>
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