<?php
require_once("../Model/DB_users.php");

if (!empty($_GET['pseudo']) && !empty($_GET['key']))
{
    $pseudonym = htmlspecialchars($_GET['pseudo']);
    $confirm_key = htmlspecialchars($_GET['key']);

    if (user::check_confirm_key_password($pseudonym, $confirm_key))
    {
        header("location: http://localhost:8080/Camagru/View/update_forgotten_password.php?id=$pseudonym&amp;key=$confirm_key");
        exit;
    }
    else
    {
        header("location: http://localhost:8080/Camagru/View/404_error.html");
        exit;
    }
}
else
{
    header("location: http://localhost:8080/Camagru/View/404_error.html");
    exit;
}
?>