<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_connect.php");

class comment
{
    static function add_comment($id_user, $id_picture, $comment)
    {
        $db = connexion();

        $statement = $db->prepare("INSERT INTO comments (id_user, id_picture, comment) VALUES (:id_user, :id_picture, :comment)");

        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);
        $statement->bindValue(':comment', $comment, PDO::PARAM_STR);

        $statement->execute();
    }

    static function get_comments($id_picture)
    {
        $db = connexion();

        $statement = $db->prepare("SELECT id_comment, id_user, id_picture, comment, DATE_FORMAT(datecomment, 'le %d/%m/%Y à %Hh%i') AS datecomment FROM comments WHERE id_picture=:id_picture ORDER BY id_comment DESC");

        $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);

        $statement->execute();

        $count = $statement->rowCount();
        $id_comments = $statement->fetchAll();

        $result = array($count, $id_comments);

        return $result;
    }

    static function get_user($id_user)
    {
        $db = connexion();

        $statement = $db->prepare("SELECT pseudonym FROM users WHERE id_user=:id_user");

        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->fetch();

        return $result[0];
    }
}

?>