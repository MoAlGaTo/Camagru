<?php
require_once("../Model/DB_users.php");
// require_once("../View/form.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['connexion_butt']))
    {
        $empty_message_alert_connect = NULL;
        $connector_message_alert = NULL;
        $password_message_alert_connect = NULL;

        if (isset($_POST['pseudo_mail']) && isset($_POST['password_user']))
        {
            $pseudo_mail = htmlspecialchars($_POST['pseudo_mail']);
            $password = htmlspecialchars($_POST['password_user']);
            $password = hash('sha256', $password);

            $identity = user::account_connect($pseudo_mail);

            if ($identity)
            {
                if ($password === $identity['passworduser'])
                {
                    session_start();
                    $_SESSION['lastname'] = $identity['lastname'];
                    $_SESSION['firstname'] = $identity['firstname'];
                    $_SESSION['pseudonym'] = $identity['pseudonym'];
                    $_SESSION['email'] = $identity['email'];
                    header('location: ../View/admin_page.php');
                    exit;
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