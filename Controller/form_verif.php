<?php
require_once("../View/form.php");
require_once("../Model/DB_users.php");

function insctiption()
{
    $lastname_verif = "#^[\.]{1,35}$#";
    $firstname_verif = "#^[\.]{1,35}$#";
    $pseudonym_verif = "#^[\.]+{1,15}$#";
    $email_verif = "#^[0-9a-zA-Z-_]+@[a-zA-Z-_]{2,}.[a-zA-Z]{2,4}$#";
    $password_verif = "#^([.]*[a-z]+[A-Z]+[0-9]+[-\#_*@\.]+){6,15}$#";

    $empty_message_alert = NULL;
    $lastname_message_alert = NULL;
    $firstname_message_alert = NULL;
    $pseudo_message_alert = NULL;
    $email_message_alert = NULL;
    $password_message_alert = NULL;
    $password_confirm_message_alert = NULL;

    $pseudo_exist = new DataBase;
    $email_exist = new DataBase;

    if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['pseudonym']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm'])) 
    {
        $lastname = htmlspecialchars($_POST['lastname']);
        $firstname = htmlspecialchars($_POST['firstname']);
        $pseudonym = htmlspecialchars($_POST['pseudonym']);
        $email = htmlspecialchars($_POST['email']);
        $passworduser = htmlspecialchars($_POST['password']);
        $passworduser_confirm = htmlspecialchars($_POST['password_confirm']);

        if (!preg_match($lastname_verif, $lastname))
        {
            $lastname_message_alert = "Le champ \"Nom\" doit contenir 1 caractère minimum et 35 caractères maximum.";
        }
        if (!preg_match($firstname_verif, $firstname))
        {
            $firstname_message_alert = "Le champ \"Prénom\" doit contenir 1 caractère minimum et 35 caractères maximum.";
        }
        if (!preg_match($pseudonym_verif, $pseudonym))
        {
            $pseudo_message_alert = "Votre Pseudonyme doit contenir 1 caractère minimum et 15 caractères maximum.";
        }
        if (!preg_match($email_verif, $email)) 
        {
            $email_message_alert = "Format de l'adresse E-mail invalide.";
        }
        if (!preg_match($password_verif, $passworduser)) 
        {
            $password_message_alert = "Votre mot de passe doit contenir 6 caractère minimum et 15 caractères maximum, et au moins 1 majuscule, 1 chiffre et 1 caractère spécial (\"-\", \"#\", \"_\", \"*\", \"@\", \".\")";
        }
        if (!($passworduser === $passworduser_confirm)) 
        {
            $password_confirm_message_alert = "Le mot de passe ne correspond pas.";
        }
        if (empty($lastname_message_alert) && empty($firstname_message_alert) && empty($pseudo_message_alert) && empty($email_message_alert) && empty($password_message_alert) && empty($password_confirm_message_alert))
        {
            $add_user_object = new user;
            $add_user_object->add_user($lastname, $firstname, $pseudonym, $email, $passworduser);
        }
    } 
    else 
    {
        $empty_message_alert = "Tous les champs doivent être remplis.";
    }
}
