<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_connect.php");

class picture
{
    static function add_picture($image, $id_user)
    {
        $db = connexion();

        $statement = $db->prepare("INSERT INTO pictures (picture, id_user) VALUES (:picture, :id_user)");

        $statement->bindValue(':picture', $image, PDO::PARAM_STR);
        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }

    static function get_user_pictures($id)
    {
        $db = connexion();

        $statement = $db->prepare("SELECT * FROM pictures WHERE id_user=:id ORDER BY id_picture DESC");

        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        $count = $statement->rowCount();
        $all = $statement->fetchAll();
        $result = array($count, $all);

        return $result;
    }

    static function get_pictures()
    {
        $db = connexion();

        $statement = $db->prepare("SELECT * FROM pictures ORDER BY id_picture DESC");

        $statement->execute();

        $count = $statement->rowCount();
        $all = $statement->fetchAll();
        $result = array($count, $all);

        return $result;
    }

    static function delete_picture($id_picture)
    {
        $db = connexion();

        $statement = $db->prepare('DELETE FROM pictures WHERE id_picture=:id_picture');

        $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);

        $statement->execute();
    }
}

?>