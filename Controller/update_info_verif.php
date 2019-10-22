<?php
require_once("../Model/DB_users.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['update_butt']))
    {
        $name_verif = "/^[^!@#$%^&*(),.;?\":{}\[\]|<>0-9\t]{1,40}$/";
        $pseudonym_verif = "/^.{1,15}$/";
        $email_verif = "/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i";

        $empty_message_alert = NULL;
        $lastname_message_alert = NULL;
        $firstname_message_alert = NULL;
        $pseudo_message_alert = NULL;
        $email_message_alert = NULL;
        $pseudo_exist_message_alert = NULL;
        $email_exist_message_alert = NULL;
        $result_message = NULL;

        $update_user_object = new user;

        if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['pseudonym']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm']))
        {
            $lastname = htmlspecialchars($_POST['lastname']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $pseudonym = htmlspecialchars($_POST['pseudonym']);
            $email = htmlspecialchars($_POST['email']);
            $id = $_SESSION['id_user'];
			
            if (!preg_match($name_verif, $lastname))
            {
                $lastname_message_alert = "Le champ \"Nom\" doit contenir 1 caractère minimum et 40 caractères maximum et ne doit pas contenir de caractères spéciaux.";
            }
            if (!preg_match($name_verif, $firstname))
            {
                $firstname_message_alert = "Le champ \"Prénom\" doit contenir 1 caractère minimum et 40 caractères maximum et ne doit pas contenir de caractères spéciaux.";
            }
            if (!preg_match($pseudonym_verif, $pseudonym))
            {
                $pseudo_message_alert = "Votre pseudonyme doit contenir 1 caractère minimum et 15 caractères maximum.";
            }
            if (!preg_match($email_verif, $email))
            {
                $email_message_alert = "Format de l'adresse e-mail invalide.";
            }
            if ($update_user_object->check_pseudo($pseudonym))
            {
                $pseudo_exist_message_alert = "Le pseudonyme existe déjà";
            }
            if ($update_user_object->check_email($email))
            {
                $email_exist_message_alert = "L'adresse e-mail existe déjà";
            }
            if (empty($lastname_message_alert) && empty($firstname_message_alert) && empty($pseudo_message_alert) && empty($email_message_alert) && empty($email_exist_message_alert) && empty($pseudo_exist_message_alert))
            {
                if ($update_user_object->edit_information($lastname, $firstname, $pseudonym, $email, $id))
                {
                    $result_message = "Vos informations ont bien été modifiées.";
                }
                else
                {
                    $result_message = "Échec de la modification de vos informations.";
                }
            } 
        }
        else
        {
            $empty_message_alert = "Tous les champs doivent être remplis.";
        }
    }
    else
    {
        header("location: http://localhost:8080/Camagru/View/404_error.html");
    }
}
?>