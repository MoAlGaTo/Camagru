<?php
require_once("../Model/DB_users.php");

if (!empty($_GET['pseudo']) && !empty($_GET['key']))
{
    $pseudonym = htmlspecialchars($_GET['pseudo']);
    $confirm_key = htmlspecialchars($_GET['key']);

    $verification_object = new user;

    if (($verification_object->check_pseudo($pseudonym)) && ($verification_object->check_confirm_key($confirm_key)) && ($verification_object->check_confirm_account_key($pseudonym, 0)))
    {
        if ($verification_object->set_confirm_account_key($pseudonym))
        {
            header("location: http://localhost:8080/Camagru/View/verified_email.php");
        }
    }
    else if (($verification_object->check_pseudo($pseudonym)) && ($verification_object->check_confirm_key($confirm_key)) && ($verification_object->check_confirm_account_key($pseudonym, 1)))
    {
        header("location: http://localhost:8080/Camagru/View/already_verified.php");
    }
    else
    {
        header("location: http://localhost:8080/Camagru/View/404_error.html");
    }
}
else
{
   header("location: http://localhost:8080/Camagru/View/404_error.html");
}
?>