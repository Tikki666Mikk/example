<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

require_once("database.php");

class Handler extends Database
{
    public function cropImage($aInitialImageFilePath, $aNewImageFilePath, $aNewImageWidth, $aNewImageHeight, $source)
    {
        if (($aNewImageWidth < 0) || ($aNewImageHeight < 0)) {
            return false;
        }

        $lAllowedExtensions = array(1 => "gif", 2 => "jpeg", 3 => "png", 4 => 'jpg');

        list($lInitialImageWidth, $lInitialImageHeight, $lImageExtensionId) = getimagesize($aInitialImageFilePath);

        if (!array_key_exists($lImageExtensionId, $lAllowedExtensions)) {
            return false;
        }
        $lImageExtension = $lAllowedExtensions[$lImageExtensionId];

        $func = 'imagecreatefrom' . $lImageExtension;
        $lInitialImageDescriptor = $func($aInitialImageFilePath);

        $lCroppedImageWidth = 0;
        $lCroppedImageHeight = 0;
        $lInitialImageCroppingX = 0;
        $lInitialImageCroppingY = 0;

        if ($aNewImageWidth / $aNewImageHeight > $lInitialImageWidth / $lInitialImageHeight) {
            $lCroppedImageWidth = floor($lInitialImageWidth);
            $lCroppedImageHeight = floor($lInitialImageWidth * $aNewImageHeight / $aNewImageWidth);
            $lInitialImageCroppingY = floor(($lInitialImageHeight - $lCroppedImageHeight) / 2);
        } else {
            $lCroppedImageWidth = floor($lInitialImageHeight * $aNewImageWidth / $aNewImageHeight);
            $lCroppedImageHeight = floor($lInitialImageHeight);
            $lInitialImageCroppingX = floor(($lInitialImageWidth - $lCroppedImageWidth) / 2);
        }

        $lNewImageDescriptor = imagecreatetruecolor($aNewImageWidth, $aNewImageHeight);

        $transparent_source_index = imagecolortransparent($source);

        if ($transparent_source_index !== -1) {
            $transparent_color = imagecolorsforindex($source, $transparent_source_index);

            $transparent_destination_index = imagecolorallocate($lNewImageDescriptor, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
            imagecolortransparent($lNewImageDescriptor, $transparent_destination_index);

            imagefill($lNewImageDescriptor, 0, 0, $transparent_destination_index);
        }

        imagealphablending($lNewImageDescriptor, false);

        imagesavealpha($lNewImageDescriptor, true);

        imagecopyresampled($lNewImageDescriptor, $lInitialImageDescriptor, 0, 0, $lInitialImageCroppingX, $lInitialImageCroppingY, $aNewImageWidth, $aNewImageHeight, $lCroppedImageWidth, $lCroppedImageHeight);
        $func = 'image' . $lImageExtension;

        return $func($lNewImageDescriptor, $aNewImageFilePath);
    }

    public function upload_img($name, $dir_name)
    {
        if (isset($_FILES['photo'])) {
            $tmp_name = $_FILES[$name]['tmp_name'];
            $file_name = $dir_name . '/' . substr(time(), 0, -2) . $_FILES[$name]['name'];

            $type = strtolower(substr(strrchr($file_name, "."), 1));

            if ($type == 'jpg' || $type == 'jpeg' || $type == 'png' || $type == 'gif' || $type == '') {
                if ($_FILES[$name]['size'] <= 10000000) {
                    move_uploaded_file($tmp_name, $file_name);

                    $this->cropImage($file_name, 'avatars/' . substr(time(), 0, -2) . $_FILES[$name]['name'], 60, 60, $file_name);

                    unlink($file_name);
                } else {
                    $this->death('Размер аватарки превышает 100 Кб');
                }
            } else {
                $this->death('Не подходящий формат аватарки');
            }

        }
    }

    public function upload_gallery($name, $dir_name)
    {

        for ($i = 0; $i <= 4; $i++) {
            if (isset($_FILES['photos'])) {
                $tmp_name = $_FILES[$name]['tmp_name'][$i];
                $file_name = $dir_name . '/' . substr(time(), 0, -2) . $_FILES[$name]['name'][$i];
                $type = strtolower(substr(strrchr($file_name, "."), 1));
                if ($type == 'jpg' || $type == 'jpeg' || $type == 'png' || $type == 'gif' || $type == '') {

                    if ($_FILES[$name]['size'][$i] <= 1000000) {
                        move_uploaded_file($tmp_name, $file_name);

                        $size = getimagesize($file_name);

                        $height_img = $size[0];
                        $width_img = $size[1];

                        if ($height_img == $width_img) {
                            $newwidth = 700;
                            $newheight = 700;
                        } elseif ($height_img > $width_img) {
                            $newwidth = 700;
                            $newheight = 600;
                        } else {
                            $newwidth = 600;
                            $newheight = 700;
                        };

                        $this->cropImage($file_name, 'gallery/' . substr(time(), 0, -2) . $_FILES[$name]['name'][$i], $newwidth, $newheight, $file_name);

                        unlink($file_name);
                    } else {
                        $this->death('Размер фотографии ' . (1 + $i) . ' превышает 1 Мб');
                    }
                } else {
                    $this->death('Фотография ' . (1 + $i) . ' не подходит по формату');

                }
            }
        }
    }

    public function insert_db()
    {
        $sex = $_POST['sex'];
        $lastname = $_POST['lastname'];
        $name = $_POST['name'];
        $patronymic = $_POST['patronymic'];
        $date = $_POST['date'];
        if (!$_FILES['photo']['name'] == '') {
            $photo = substr(time(), 0, -2) . $_FILES['photo']['name'];
        } else {
            $photo = $_FILES['photo']['name'];
        }
        $color = $_POST['color'];
        $quality = $_POST['quality'];
        $diligence = $_POST['diligence'];
        $neatness = $_POST['neatness'];
        $self_learning = $_POST['self-learning'];
        $hard_work = $_POST['hard-work'];
        if (!$_FILES['photos']['name'][0] == '') {
            $photo_gal_1 = substr(time(), 0, -2) . $_FILES['photos']['name'][0];
        } else {
            $photo_gal_1 = $_FILES['photos']['name'][0];
        }

        if (!$_FILES['photos']['name'][1] == '') {
            $photo_gal_2 = substr(time(), 0, -2) . $_FILES['photos']['name'][1];
        } else {
            $photo_gal_2 = $_FILES['photos']['name'][1];
        }

        if (!$_FILES['photos']['name'][2] == '') {
            $photo_gal_3 = substr(time(), 0, -2) . $_FILES['photos']['name'][2];
        } else {
            $photo_gal_3 = $_FILES['photos']['name'][2];
        }

        if (!$_FILES['photos']['name'][3] == '') {
            $photo_gal_4 = substr(time(), 0, -2) . $_FILES['photos']['name'][3];
        } else {
            $photo_gal_4 = $_FILES['photos']['name'][3];
        }

        if (!$_FILES['photos']['name'][4] == '') {
            $photo_gal_5 = substr(time(), 0, -2) . $_FILES['photos']['name'][4];
        } else {
            $photo_gal_5 = $_FILES['photos']['name'][4];
        }

        $sql = ("INSERT INTO questionnaire(
                `sex`, 
                `lastname`, 
                `name`, 
                `patronymic`, 
                `birthday`, 
                `photo`, 
                `color`, 
                `quality`, 
                `diligence`, 
                `neatness`, 
                `self-learning`, 
                `hard-work`, 
                `photo_gallery_1`, 
                `photo_gallery_2`, 
                `photo_gallery_3`, 
                `photo_gallery_4`, 
                `photo_gallery_5`) VALUES (
                            :sex,
                            :lastname,
                            :fname,
                            :patronymic,
                            :bday,
                            :photo,
                            :color,
                            :quality,
                            :diligence,
                            :neatness,
                            :self_learning,
                            :hard_work,
                            :photo_gallery_1,
                            :photo_gallery_2,
                            :photo_gallery_3,
                            :photo_gallery_4,
                            :photo_gallery_5
                            )");

        $statement = $this->getDB()->prepare($sql);

        $statement->bindParam(':sex', $sex, PDO::PARAM_STR);
        $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindParam(':fname', $name, PDO::PARAM_STR);
        $statement->bindParam(':patronymic', $patronymic, PDO::PARAM_STR);
        $statement->bindParam(':bday', $date, PDO::PARAM_STR);
        $statement->bindParam(':photo', $photo, PDO::PARAM_STR);
        $statement->bindParam(':color', $color, PDO::PARAM_STR);
        $statement->bindParam(':quality', $quality, PDO::PARAM_STR);
        $statement->bindParam(':diligence', $diligence, PDO::PARAM_STR);
        $statement->bindParam(':neatness', $neatness, PDO::PARAM_STR);
        $statement->bindParam(':self_learning', $self_learning, PDO::PARAM_STR);
        $statement->bindParam(':hard_work', $hard_work, PDO::PARAM_STR);
        $statement->bindParam(':photo_gallery_1', $photo_gal_1, PDO::PARAM_STR);
        $statement->bindParam(':photo_gallery_2', $photo_gal_2, PDO::PARAM_STR);
        $statement->bindParam(':photo_gallery_3', $photo_gal_3, PDO::PARAM_STR);
        $statement->bindParam(':photo_gallery_4', $photo_gal_4, PDO::PARAM_STR);
        $statement->bindParam(':photo_gallery_5', $photo_gal_5, PDO::PARAM_STR);


        $this->upload_img('photo', 'tmp');

        $this->upload_gallery('photos', 'tmp');

        $statement->execute();

        echo '<br> Ваши данные записаны <br> Через 2 секунды вы вернетесь на главную страницу<br>';

        header('refresh:2;url=index.php');
    }
}

class Admin_Panel extends Database
{
    public function auth($login, $password)
    {
        $admin = "SELECT `id`, `login`, `password` FROM `adminka` WHERE `login` = '" . $login . "' LIMIT 1 ";

        foreach ($this->getDB()->query($admin) as $user) {
            $db_pass = $user['password'];
        }

        if ($password === $db_pass) {
            $_SESSION['auth'] = 'admin';

            header('refresh:1;url=admin.php');
        } else {
           $this->death('Данные введены не верно');
        }
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        session_destroy();
        header('Location: index.php');
    }

    public function getSortingQuery($sorting_query = '')
    {
        $sorting_db = "SELECT * FROM `questionnaire` " . $sorting_query;
        return $sorting_db;
    }

    public function select_db($sorting_query)
    {
        foreach ($this->getDB()->query($sorting_query) as $info) {

            echo '<div class="popup-container">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="#" class="open-popup">
                                <span class="sex">Пол: ' . $info['sex'] . '</span>
                                <span class="lastname">Фамилия: ' . $info['lastname'] . '</span>
                                <span class="name">Имя: ' . $info['name'] . '</span>
                                <span class="patronymic">Отчество: ' . $info['patronymic'] . '</span>
                                <span class="birthday">Дата рождения: ' . $info['birthday'] . '</span>
                            </a>
                        </div>
                        
                        <div class="popup">
                        <a href="#" class="close">Закрыть</a>
                                <div class="sex">Пол: ' . $info['sex'] . '</div>
                                <div class="lastname">Фамилия: ' . $info['lastname'] . '</div>
                                <div class="name">Имя: ' . $info['name'] . '</div>
                                <div class="patronymic">Отчество: ' . $info['patronymic'] . '</div>
                                <div class="birthday">Дата рождения: ' . $info['birthday'] . '</div>
                                <div class="photo">
                                    Аватар:
                                    <img src="avatars/' . $info['photo'] . '" alt="#" class="photo">
                                </div>
                                <div class="color">
                                    цвет:
                                    <div class="color-box" style=" background: ' . $info['color'] . '"></div>
                                </div>
                                <div class="quality">Личные качества: ' . $info['quality'] . '</div>
                                <div class="skills">Навыки:' . $info['diligence'] . ' ' . $info['neatness'] . ' ' . $info['self-learning'] . ' ' . $info['hard-work'] . '</div>
                                <div class="photos">
                                    Загруженные фото: <br>
                                    <img src="gallery/' . $info['photo_gallery_1'] . '" alt="#" class="photos-img">
                                    <img src="gallery/' . $info['photo_gallery_2'] . '" alt="#" class="photos-img">
                                    <img src="gallery/' . $info['photo_gallery_3'] . '" alt="#" class="photos-img">
                                    <img src="gallery/' . $info['photo_gallery_4'] . '" alt="#" class="photos-img">
                                    <img src="gallery/' . $info['photo_gallery_5'] . '" alt="#" class="photos-img">
                                </div>
                            </div>
                    </div>';
        }
    }
}


if (isset($_POST['signin'])) {
    $login = $_POST['login'];
    $password = md5($_POST['pass']);

    $qwe = new Admin_Panel();
    $qwe->auth($login, $password);
}

if (isset($_POST['logout'])) {
    $logout = new Admin_Panel();
    $logout->logout();
}

if (isset($_POST['user-info'])) {
    $user_info_submit = new Handler();
    $user_info_submit->insert_db();
}