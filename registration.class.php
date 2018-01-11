<?php

require_once('database.class..php');

class Registration extends Database
{

    public function registration_user()
    {
        $login = $_POST['login'];
        $password = md5(md5($_POST['password']));
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $patronymic = $_POST['patronymic'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $specializations = $_POST['specializations'];
        $about = $_POST['about'];

        $sql = ("INSERT INTO `users`(
                `login`,
                `password`,
                `firstName`,
                `lastName`,
                `patronymic`,
                `email`,
                `phone`,
                `specializations`,
                `about`) VALUES (
                    :login,
                    :password,
                    :firstName,
                    :lastName,
                    :patronymic,
                    :email,
                    :phone,
                    :specializations,
                    :about)");

        $statement = $this->getDB()->prepare($sql);

        $statement->bindParam(':login', $login, PDO::PARAM_STR);
        $statement->bindParam(':password', $password, PDO::PARAM_STR);
        $statement->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $statement->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $statement->bindParam(':patronymic', $patronymic, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':specializations', $specializations, PDO::PARAM_STR);
        $statement->bindParam(':about', $about, PDO::PARAM_STR);

        $statement->execute();
    }
}