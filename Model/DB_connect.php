<?php

class DataBase
{
    public function __construct()
    {
        try
        {
            $db = new PDO('mysql:host=localhost:3306;dbname:camagru_db;charset=utf8', 'root', 'mohamedali');
            return $db;
        }
        catch (Exception $error)
        {
            die('Erreur de connexion à la base de données (Database Connection Error)...');
        }
    }
}

?>