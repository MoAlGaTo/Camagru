<?php

require_once("Model/DB_connect.php");

class user
{
    $db = new DataBase;

    public function add_user()
    {
       $db->prepare('INSERT INTO users (lastname, firstname, pseudonym, email, passworduser)
        VALUES ()');
    }
}

?>