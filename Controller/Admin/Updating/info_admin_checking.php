<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_users.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['valid_butt']))
    {
        $temporary_info_password = htmlspecialchars($_POST['password']);

        if (!empty($_POST['password']))
        {
            $passworduser = htmlspecialchars($_POST['password']);
            $passworduser = hash('sha256', $passworduser);

            if ($passworduser == $_SESSION['passworduser'])
            {
                $authentication = true;
            }
            else
            {
                $result_pass_message = 'Mot de passe erroné.';
            }
        }
        else
        {
            $result_pass_message = 'Veuillez remplir le champ.';
        }
    }
    else if (isset($_POST['update_butt']))
    {
        $temporary_lastname = htmlspecialchars($_POST['lastname']);
        $temporary_firstname = htmlspecialchars($_POST['firstname']);
        $temporary_pseudonym = htmlspecialchars($_POST['pseudonym']);
        $temporary_email = htmlspecialchars($_POST['email']);

        $authentication = true;
        $name_verif = "/^[^!@#$%^&*(),.;?\":{}\[\]|<>0-9\t]{1,40}$/";
        $pseudonym_verif = "/^.{1,15}$/";
        $email_verif = "/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i";

        $update_user_object = new user;

        if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['pseudonym']) && !empty($_POST['email']))
        {
            $lastname = htmlspecialchars($_POST['lastname']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $pseudonym = htmlspecialchars($_POST['pseudonym']);
            $email = htmlspecialchars($_POST['email']);
            $receive_notif = htmlspecialchars($_POST['radio']);
            if ($receive_notif == 'yes')
            {
                $receive_notif = 1;
            }
            else
            {
                $receive_notif = 0;
            }
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
            if ($pseudonym != $_SESSION['pseudonym'])
            {
                if ($update_user_object->check_pseudo($pseudonym))
                {
                    $pseudo_exist_message_alert = "Le pseudonyme existe déjà";
                }
            }
            if ($email != $_SESSION['email'])
            {
                if ($update_user_object->check_email($email))
                {
                    $email_exist_message_alert = "L'adresse e-mail existe déjà";
                }
                
            }
            if (empty($lastname_message_alert) && empty($firstname_message_alert) && empty($pseudo_message_alert) && empty($email_message_alert) && empty($email_exist_message_alert) && empty($pseudo_exist_message_alert))
            {
                if ($_SESSION['key_infup'] == 0)
                {
                    $key_infup = 1;
                    $_SESSION['key_infup'] = 1;
                }
                else
                {
                    $key_infup = 0;
                    $_SESSION['key_infup'] = 0;
                }
                if ($update_user_object->edit_information($lastname, $firstname, $pseudonym, $email, $id , $key_infup, $receive_notif))
                {
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['pseudonym'] = $pseudonym;
                    $_SESSION['email'] = $email;
                    $_SESSION['receive_notif'] = $receive_notif;
                    header("location: /Camagru/View/Admin/Profile/profile_admin.php?ic=1");
                    exit;
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
        header("location: /Camagru/View/404_error.html");
        die();
    }
}
