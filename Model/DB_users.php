<?php

require_once("DB_connect.php");

class user
{
    public function check_pseudo($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare("SELECT * FROM users WHERE pseudonym=:pseudonym");

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }

    public function check_email($email)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE email=:email');

        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }

    public function add_user($lastname, $firstname, $pseudonym, $email, $password_user, $confirm_key)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('INSERT INTO users (lastname, firstname, pseudonym, email, passworduser, confirm_key)
        VALUES (:lastname, :firstname, :pseudonym, :email, :password_user, :confirm_key)');

        $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password_user', $password_user, PDO::PARAM_STR);
        $statement->bindValue(':confirm_key', $confirm_key, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }

    public function check_confirm_key($confirm_key)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE confirm_key=:confirm_key');

        $statement->bindValue(':confirm_key', $confirm_key, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }

    public function check_confirm_account_key($pseudonym, $confirm_account_key)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:pseudonym AND confirm_account_key=:confirm_account_key');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);
        $statement->bindValue(':confirm_account_key', $confirm_account_key, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }

    public function set_confirm_account_key($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('UPDATE users SET confirm_account_key=1 WHERE pseudonym=:pseudonym');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }

    public function edit_information($lastname, $firstname, $pseudonym, $email, $id)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('UPDATE users 
        SET lastname=:lastname, firstname=:firstname, pseudonym=:pseudonym, email=:email  WHERE id_user=:id');

        $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }

    public function edit_password($password_user, $id)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('UPDATE users SET passworduser=:password_user WHERE id_user=:id');

        $statement->bindValue(':password_user', $password_user, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }

    public function account_connect($connector)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:connector OR email=:connector');

        $statement->bindValue(':connector', $connector, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        if ($count)
        {
            $result = $statement->fetch();
            return $result;
        }
        else
        {
            return $count;
        }
    }

    public function delete_account($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();
        
        $statement = $db->prepare('DELETE FROM users WHERE pseudonym=:pseudonym');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return ($result);
    }
}
