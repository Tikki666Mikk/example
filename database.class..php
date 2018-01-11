<?php

class Database
{

    public function getDB()
    {
        try {
            $db = new PDO("mysql:host=localhost; dbname=abi; charset=utf8", "root", "NekoRi12");
            return $db;
        }
        catch (PDOException $e) {
            die('Ошибка!' . $e->getMessage());
        }
    }
}