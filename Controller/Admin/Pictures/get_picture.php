<?php
session_start();

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_pictures.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['picture']))
    {
        $id_user = $_SESSION['id_user'];
        $image = htmlspecialchars($_POST['picture']);
        picture::add_picture($image, $id_user);

    }
    else
    {
        header("location: /Camagru/View/404_error.html");
    }
}


?>