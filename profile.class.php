<?php

require_once('database.class..php');

class Profile extends Database
{

    public function echoProfile()
    {
        $query = "SELECT `id`, `login`, `password`, `firstName`, `lastName`, `patronymic`, `email`, `phone`, `specializations`, `about` FROM `users` WHERE `login` = '" . $_SESSION['login'] . "' LIMIT 1";

        foreach ($this->getDB()->query($query) as $info) {
            echo '<div class="user_info">
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
                    </div>';
        }
    }

    public function logout() {
        $_SESSION['auth'] = false;
        session_destroy();
    }
}