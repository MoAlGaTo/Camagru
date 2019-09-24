<?php
error_reporting(E_ALL);
require_once("Model/DB_connect.php");

class user
{
    $db = new DataBase;

    public function add_user($lastname, $firstname, $pseudonym, $email, $passworduser)
    {
       $db->prepare('INSERT INTO users (lastname, firstname, pseudonym, email, passworduser)
        VALUES ($lastname, $firstname, $pseudonym, $email, $passworduser)');
    }

    public function edit_pseudo($pseudonym, $id)
    {
        $db->exec('UPDATE users SET pseudonym=$pseudonym  WHERE ID=$id')
    }
}

?>