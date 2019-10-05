<?php

require_once("DB_connect.php");

class user
{
    public function check_pseudo($pseudonym)
    {
        $db = new DataBase;

        $statement = $db->prepare('SELECT pseudonym FROM users WHERE pseudonym=:pseudonym');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }

    public function check_email($email)
    {
        $db = new DataBase;

        $statement = $db->prepare('SELECT email FROM users WHERE email=:email');

        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }

    public function add_user($lastname, $firstname, $pseudonym, $email, $passworduser)
    {
        $db = new DataBase;

        $statement = $db->prepare('INSERT INTO users (lastname, firstname, pseudonym, email, passworduser)
        VALUES (:lastname, :firstname, :pseudonym, :email, :passworduser)');

        $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':passworduser', $passworduser, PDO::PARAM_STR);

        $result = $statement->execute();

        return $result;
    }

    public function edit_information($lastname, $firstname, $pseudonym, $email)
    {
        $db = new DataBase;

        $statement = $db->prepare('UPDATE users 
        SET lastname=:lastname, firstname=:firstname, pseudonym=:pseudonym, email=:email  WHERE ID=:id');

        $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        $result = $statement->execute();

        return $result;
    }

    public function edit_password($id, $passworduser)
    {
        $db = new DataBase;

        $statement = $db->prepare( 'UPDATE users SET passworduser=:passworduser WHERE ID=:id');

        $statement->bindValue(':passworduser', $passworduser, PDO::PARAM_STR);

        $result = $statement->execute();

        return $result;
    }
}
?>  