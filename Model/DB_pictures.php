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
}

?>