<?php
require_once("../Model/DB_users.php");

if (!empty($_GET['pseudo']) && !empty($_GET['key']))
{
    $pseudonym = htmlspecialchars($_GET['pseudo']);
    $confirm_key = htmlspecialchars($_GET['key']);

    if ((user::check_confirm_key($pseudonym, $confirm_key)))
    {
        if (user::check_confirm_account_key($pseudonym))
        {
            if (user::set_confirm_account_key($pseudonym))
            {
                header("location: http://localhost:8080/Camagru/View/verified_email.php?pseudo=$pseudonym");
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
            header("location: http://localhost:8080/Camagru/View/already_verified.php?pseudo=$pseudonym");
            exit;
        }
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