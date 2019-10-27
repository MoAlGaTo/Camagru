<?php
require_once("../Model/DB_users.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['modif_butt']))
    {
        $pseudonym = htmlspecialchars($_GET['pseudo']);
        $confirm_key = htmlspecialchars($_GET['key']);
        $password_verif = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*(),.;?\":{}\[\]|<>])(?=.{6,50}$)/";
        
        if (empty($pseudonym) || empty($confirm_key))
        {
            header("location: http://localhost:8080/Camagru/View/404_error.html");
        }
        if (!empty($_POST['password']) && !empty($_POST['password_confirm']))
        {
            $passworduser = htmlspecialchars($_POST['password']);
            $passworduser_confirm = htmlspecialchars($_POST['password_confirm']);

            if (!preg_match($password_verif, $passworduser))
            {
                $password_message_alert = "Votre mot de passe doit contenir 6 caractère minimum et 50 caractères maximum, et au moins 1 majuscule, 1 chiffre et 1 caractère spécial (ex: \"!\", \"\$\", \"&\", \".\", \"%\", \"*\", \"@\", etc ...)";
            }
            if (!($passworduser === $passworduser_confirm))
            {
                $password_confirm_message_alert = "Le mot de passe ne correspond pas.";
            }

            $passworduser = hash('sha256', $passworduser);

            if ((user::check_password($pseudonym)) === $passworduser)
            {
                $empty_message_alert = "Votre mot de passe correspond à l'ancien. Veuillez le modifer.";
            }
            if (empty($password_message_alert) && empty($password_confirm_message_alert) && empty($empty_message_alert))
            {
                if (user::check_confirm_key_password($pseudonym, $confirm_key))
                {
                    if (user::check_confirm_account_key_password($pseudonym) == 0)
                    {
                        if (user::edit_password($passworduser, $pseudonym))
                        {
                            if (user::set_confirm_password_key(1, $pseudonym))
                            {
                                header("location: http://localhost:8080/Camagru/View/forgot_password_updated.php?pseudo=$pseudonym");
                            }
                            else
                            {
                                $result_message = 'Échec de la modification de votre mot de passe2.';
                            }
                        }
                        else
                        {
                            $result_message = "Échec de la modification de votre mot de passe1.";
                        }
                    }
                    else
                    {
                        $result_message = "Votre mot de passe a déjà été modifié avec ce lien.";
                    }
                }
                else
                {
                    header("location: http://localhost:8080/Camagru/View/404_error.html");
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
