<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_likes.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['add_like']))
    {
        $id_user = $_SESSION['id_user'];
        $id_picture = htmlspecialchars($_POST['add_like']);
        like::add_like($id_user, $id_picture);
    }
    else
    {
        header("location: /Camagru/View/404_error.html");
    }
}

?>