<?php
require_once("../Model/DB_users.php");
require_once("../View/form.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if ($_POST['connexion_butt'])
    {
        function connect()
        {
            $empty_message_alert_connect = NULL;
            $connector_message_alert = NULL;
            $password_message_alert_connect = NULL;

            $pseudo_mail_exist = new user;

            if (isset($_POST['pseudo_mail']) && isset($_POST['password_user']))
            {
                $pseudo_mail = htmlspecialchars($_POST['pseudo_mail']);
                $password = htmlspecialchars($_POST['password_user']);
                $password = hash('sha256', $password);

                $identity = $pseudo_mail_exist->account_connect($pseudo_mail);

                if ($identity)
                {
                    if ($password === $identity['passworduser'])
                    {

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
    }
}
