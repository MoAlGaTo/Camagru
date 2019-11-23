<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_pictures.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['delete_button']))
    {
        $id_picture = $_POST['delete_picture'];
        picture::delete_picture($id_picture);
    }
    else
    {
        header("location: /Camagru/View/404_error.html");
    }
}

?>