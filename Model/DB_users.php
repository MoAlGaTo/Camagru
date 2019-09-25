<?php

require_once("DB_connect.php");

class user
{

    public function add_user($lastname, $firstname, $pseudonym, $email, $passworduser)
    {
        $db = new DataBase;

        $statement = $db->prepare('INSERT INTO users (lastname, firstname, pseudonym, email, passworduser)
        VALUES (:lastname, :firstname, :pseudonym, :email, :passworduser)');
    }

    public function edit_pseudo($pseudonym, $id)
    {
        $db = new DataBase;

        $statement = $db->prepare('UPDATE users SET pseudonym=:pseudonym  WHERE ID=:id');
    }
}

?>