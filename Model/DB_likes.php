<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_connect.php");

class like
{
    static function add_like($id_user, $id_picture)
    {
        $db = connexion();

        $statement = $db->prepare("SELECT * FROM likes WHERE id_user=:id_user AND id_picture=:id_picture");

        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);

        $statement->execute();

        $like_exist = $statement->rowCount();

        if ($like_exist)
        {
            $statement = $db->prepare('DELETE FROM likes WHERE id_user=:id_user AND id_picture=:id_picture');
            $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
            $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);
            $statement->execute();

        }
        else
        {
            $statement = $db->prepare("INSERT INTO likes (id_user, id_picture) VALUES (:id_user, :id_picture)");
            $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
            $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);
            $statement->execute();
        }
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