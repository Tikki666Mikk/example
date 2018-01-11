<?php
session_start();
require_once('database.class..php');

class EditProfile extends Database
{

    public function update_user()
    {
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
            `about` = :about WHERE `login` = '" . $_SESSION['login'] . "' LIMIT 1");

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
}