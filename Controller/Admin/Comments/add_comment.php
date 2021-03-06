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
            if (comment::add_comment($id_user, $id_picture, $comment_to_add))
            {
                $id_user_picture = comment::get_idUser_byIdpicture($id_picture);

                if ($id_user != $id_user_picture)
                {
                    $get_info = comment::get_user($id_user_picture);
                    if ($get_info[11] == 1)
                    {
                        $get_date = date("d-m-Y");
                        comment::send_email_notif($get_info[4], $get_info[3], $_SESSION['pseudonym'], $get_date);
                    }
                }
                
            }
        }
    }
    else
    {
        header("location: /Camagru/View/404_error.html");
        die();
    }
}

?>