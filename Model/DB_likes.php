<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_connect.php");

class like
{
    static function add_like($id_user, $id_picture)
    {
        $db = connexion();

        $statement = $db->prepare("INSERT INTO likes (id_user, id_picture) VALUES (:id_user, :id_picture)");

        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }

    static function get_likes()
    {
        $db = connexion();

        $statement = $db->prepare("SELECT * FROM likes");

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
}

?>