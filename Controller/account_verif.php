<?php
require_once("../Model/DB_users.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['inscription_butt']))
    {
        $lastname_verif = "/^[^!@#$%^&*(),.;?\":{}\[\]|<>0-9\t]{1,40}$/";
        $firstname_verif = "/^[^!@#$%^&*(),.;?\":{}\[\]|<>0-9\t]{1,40}$/";
        $pseudonym_verif = "/^.{1,15}$/";
        $email_verif = "/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i";
        $password_verif = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*(),.;?\":{}\[\]|<>])(?=.{6,50}$)/";

        $add_user_object = new user;

        if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['pseudonym']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_confirm']))
        {
            $lastname = htmlspecialchars($_POST['lastname']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $pseudonym = htmlspecialchars($_POST['pseudonym']);
            $email = htmlspecialchars($_POST['email']);
            $passworduser = htmlspecialchars($_POST['password']);
			$passworduser_confirm = htmlspecialchars($_POST['password_confirm']);
			
            if (!preg_match($lastname_verif, $lastname))
            {
                $lastname_message_alert = "Le champ \"Nom\" doit contenir 1 caractère minimum et 40 caractères maximum et ne doit pas contenir de caractères spéciaux.";
            }
            if (!preg_match($firstname_verif, $firstname))
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
            if (!preg_match($password_verif, $passworduser))
            {
                $password_message_alert = "Votre mot de passe doit contenir 6 caractère minimum et 50 caractères maximum, et au moins 1 majuscule, 1 chiffre et 1 caractère spécial (ex: \"!\", \"\$\", \"&\", \".\", \"%\", \"*\", \"@\", etc ...)";
            }
            if (!($passworduser === $passworduser_confirm))
            {
                $password_confirm_message_alert = "Le mot de passe ne correspond pas.";
            }
            if ($add_user_object->check_pseudo($pseudonym))
            {
                $pseudo_exist_message_alert = "Le pseudonyme existe déjà";
            }
            if ($add_user_object->check_email($email))
            {
                $email_exist_message_alert = "L'adresse e-mail existe déjà";
            }
            if (empty($lastname_message_alert) && empty($firstname_message_alert) && empty($pseudo_message_alert) && empty($email_message_alert) && empty($password_message_alert) && empty($password_confirm_message_alert) && empty($email_exist_message_alert) && empty($pseudo_exist_message_alert))
            {
                $passworduser = hash('sha256', $passworduser);
                $confirm_key = $add_user_object->make_confirm_key();

                if ($add_user_object->add_user($lastname, $firstname, $pseudonym, $email, $passworduser, $confirm_key))
                {
                    if ($add_user_object->send_email($email, $pseudonym, $confirm_key))
                    {
                        header("Location: http://localhost:8080/Camagru/View/unverified_email.php");
                    }
                    else
                    {
                        if ($add_user_object->delete_account($pseudonym))
                        {
                            $failure_message = "Échec de l'envoi de l'e-mail de confirmation. L'inscription n'a pu être prise en compte.";
                        }
                        else
                        {
                            $failure_message = "Échec de l'envoi de l'e-mail de confirmation. L'utilisateur a quand même été ajouté.";
                        }
                    }
                }
                else
                {
                    $failure_message = "Échec de l'ajout de l'utilisateur dans la base de données.";
                }
            } 
        }
        else
        {
            $empty_message_alert = "Tous les champs doivent être remplis.";
        }
    }
    else if (isset($_POST['connexion_butt']))
    {

        if (!empty($_POST['pseudo_mail']) && !empty($_POST['password_user']))
        {
            $pseudo_mail = htmlspecialchars($_POST['pseudo_mail']);
            $password = htmlspecialchars($_POST['password_user']);
            $password = hash('sha256', $password);

            $identity = user::account_connect($pseudo_mail);

            if ($identity)
            {
                if ($password === $identity['passworduser'])
                {
                    if ($identity['confirm_account_key'] == 1)
                    {
                        session_start();
                        $_SESSION['id_user'] = $identity['id_user'];
                        $_SESSION['lastname'] = $identity['lastname'];
                        $_SESSION['firstname'] = $identity['firstname'];
                        $_SESSION['pseudonym'] = $identity['pseudonym'];
                        $_SESSION['email'] = $identity['email'];
                        header('location: ../View/admin_page.php');
                        exit;
                    }
                    else
                    {
                        $password_message_alert_connect = "Merci de confirmer votre compte via l'email de confimation qui vous a été envoyé, avant de pouvoir vous connecter.";
                    }
                }
                else
                {
                    $password_message_alert_connect = "Mot de passe incorrect";
                }
            }
            else
            {
                $connector_message_alert = "Identifiant incorrect.";
            }
        }
        else
        {
            $empty_message_alert_connect = "Veuillez remplir tous les champs pour vous connecter.";
        }
    }
    else
    {
        header("location: http://localhost:8080/Camagru/View/404_error.html");
        exit;
    }
}