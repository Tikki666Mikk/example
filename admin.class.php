<?php

require_once('database.class..php');

class Admin extends Database
{

    public function echoAdminEvents()
    {
        foreach ($this->getDB()->query('SELECT * FROM events') as $info) {
            $date = date('Y.m.d', strtotime($info['date']));

            echo '<form method="POST" class="swiper-slide">
                            <div class="item clearfix">
                            <input type="hidden" name="get_id" class="get-id-events" value="' . $info['id'] . '">
                                <div class="img">
                                    <img src="images/' . $info['image'] . '" alt="#">
                                </div>

                                <div class="right-side">
                                    <div class="text">
                                        ' . $info['text'] . '
                                    </div>

                                    <div class="bottom-line clearfix">
                                        <div class="date">
                                            ' . $date . '
                                        </div>

                                        <a href="#" class="detail">
                                            Подробнее
                                        </a>
                                    </div>
                                </div>
                            </div>

                             <div class="panel">
                                <a href="#" class="fa fa-pencil-square-o"></a>
                                <button type="submit" name="admin_remove_events" class="fa fa-trash-o"></button>
                            </div>
                        </form>';
        }
    }

    public function echoAdminNews()
    {
        foreach ($this->getDB()->query('SELECT * FROM news') as $info) {
            $date = date('Y.m.d', strtotime($info['date']));

            echo '<form method="POST" class="swiper-slide">
                        <div class="item">
                        <input type="hidden" name="get_id" class="get-id-news" value="' . $info['id'] . '">
                            <div class="img">
                               <img src="images/' . $info['image'] . '" alt="#">
                            </div>

                            <div class="text">
                                ' . $info['text'] . '
                            </div>

                            <div class="bottom-line clearfix">
                                <div class="date">
                                    ' . $date . '
                                </div>

                                <a href="#" class="detail">
                                    Подробнее
                                </a>
                            </div>
                        </div>

                         <div class="panel">
                                <a href="#" class="fa fa-pencil-square-o"></a>
                                <button type="submit" name="admin_remove_news" class="fa fa-trash-o"></button>
                            </div>
                    </form>';
        }
    }

    public function echoAdminProfiles()
    {
        foreach ($this->getDB()->query('SELECT * FROM users') as $info) {
            echo '<form method="POST" class="swiper-slide">
                        <div class="item clearfix">
                        <input type="hidden" name="get_login" class="get-login" value="' . $info['login'] . '">
                            <ul>
                                <li>
                                    Фамилия: ' . $info['lastName'] . '
                                </li>
                
                                <li>
                                    Имя: ' . $info['firstName'] . '
                                </li>
                
                                <li>
                                    Отчество: ' . $info['patronymic'] . '
                                </li>
                
                                <li>
                                    Email: ' . $info['email'] . '
                                </li>
                
                                <li>
                                    Телефон: ' . $info['phone'] . '
                                </li>
                
                                <li>
                                    Выбранное направление: ' . $info['specializations'] . '
                                </li>
                
                                <li>
                                    О себе: <br> ' . $info['about'] . '
                                </li>
                            </ul>

                            <div class="panel">
                                <a href="#" class="fa fa-pencil-square-o"></a>
                                <button type="submit" name="admin_remove_profile" class="fa fa-trash-o"></button>
                            </div>
                        </div>
                   </form>';
        }
    }

    public function update_user()
    {
        $user = $_POST['login'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $patronymic = $_POST['patronymic'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $specializations = $_POST['specializations'];
        $about = $_POST['about'];

        $sql = ("UPDATE users SET 
            `firstName` = :firstName,
            `lastName` = :lastName,
            `patronymic` = :patronymic,
            `email` = :email,
            `phone` = :phone,
            `specializations` = :specializations,
            `about` = :about WHERE `login` = '" . $user . "' LIMIT 1");

        $statement = $this->getDB()->prepare($sql);

        $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':patronymic', $patronymic, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':specializations', $specializations, PDO::PARAM_STR);
        $statement->bindParam(':about', $about, PDO::PARAM_STR);

        $statement->execute();
    }

    public function upload_img($name, $dir_name)
    {
        $tmp_name = $_FILES[$name]['tmp_name'];
        $file_name = $dir_name . '/' . substr(time(), 0, -3) . $_FILES[$name]['name'];

        move_uploaded_file($tmp_name, $file_name);
    }

    public function update_news()
    {
        $id = $_POST['id'];
        $image = substr(time(), 0, -3) . $_FILES['edit_img_news']['name'];
        $text = $_POST['text-news'];
        $date = $_POST['date-news'];

        $sql = ("UPDATE `news` SET 
                `image`= :image,
                `text`= :text,
                `date`= :dateCreate
                 WHERE `id` = '" . $id . "'");

        $statement = $this->getDB()->prepare($sql);

        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':text', $text, PDO::PARAM_STR);
        $statement->bindParam(':dateCreate', $date, PDO::PARAM_STR);

        $this->upload_img('edit_img_news', 'images');

        $statement->execute();
    }

    public function remove_user()
    {
        $user = $_POST['get_login'];

        $sql = ("DELETE FROM `users` WHERE `login` = '" . $user . "' LIMIT 1");

        $statement = $this->getDB()->prepare($sql);

        $statement->execute();
    }

    public function remove_news()
    {
        $id = $_POST['get_id'];

        $sql = ("DELETE FROM `news` WHERE `id` = '" . $id . "' LIMIT 1");

        $statement = $this->getDB()->prepare($sql);

        $statement->execute();
    }

    public function add_news()
    {
        $image = substr(time(), 0, -3) . $_FILES['add_img_news']['name'];
        $text = $_POST['text-news'];
        $date = $_POST['date-news'];

        $sql = ("INSERT INTO `news` ( 
                `image`,
                `text`,
                `date`) VALUES (
                 :image,
                 :text,
                 :dateCreate)");

        $statement = $this->getDB()->prepare($sql);

        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':text', $text, PDO::PARAM_STR);
        $statement->bindParam(':dateCreate', $date, PDO::PARAM_STR);

        $this->upload_img('add_img_news', 'images');

        $statement->execute();
    }

    public function update_event()
    {
        $id = $_POST['id'];
        $image = substr(time(), 0, -3) . $_FILES['edit_img_events']['name'];
        $text = $_POST['text-events'];
        $date = $_POST['date-events'];

        $sql = ("UPDATE `events` SET 
                `image`= :image,
                `text`= :text,
                `date`= :dateCreate
                 WHERE `id` = '" . $id . "'");

        $statement = $this->getDB()->prepare($sql);

        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':text', $text, PDO::PARAM_STR);
        $statement->bindParam(':dateCreate', $date, PDO::PARAM_STR);

        $this->upload_img('edit_img_events', 'images');

        $statement->execute();
    }

    public function remove_events()
    {
        $id = $_POST['get_id'];

        $sql = ("DELETE FROM `events` WHERE `id` = '" . $id . "' LIMIT 1");

        $statement = $this->getDB()->prepare($sql);

        $statement->execute();
    }

    public function add_events()
    {
        $image = substr(time(), 0, -3) . $_FILES['add_img_events']['name'];
        $text = $_POST['text-events'];
        $date = $_POST['date-events'];

        $sql = ("INSERT INTO `events` ( 
                `image`,
                `text`,
                `date`) VALUES (
                 :image,
                 :text,
                 :dateCreate)");

        $statement = $this->getDB()->prepare($sql);

        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':text', $text, PDO::PARAM_STR);
        $statement->bindParam(':dateCreate', $date, PDO::PARAM_STR);

        $this->upload_img('add_img_events', 'images');

        $statement->execute();
    }
}

