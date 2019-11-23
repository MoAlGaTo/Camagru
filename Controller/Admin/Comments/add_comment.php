<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_comments.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['add_like']))
{
    if (isset($_POST['add_comment']))
    {
        $comment_to_add = htmlspecialchars($_POST['comment']);
        $id_user = $_SESSION['id_user'];
        $id_picture = $_POST['picture'];
        $compare = "/^.{1,200}$/";

        if (preg_match($compare, $comment_to_add))
        {   
            comment::add_comment($id_user, $id_picture, $comment_to_add);
        }
    }
    else
    {
        header("location: /Camagru/View/404_error.html");
    }
}

?>