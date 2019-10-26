<?php
require_once("../Model/DB_users.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['modif_butt']))
    {
        if (!empty($_POST['email']))
        {
            $email_forgot = htmlspecialchars($_POST['email']);
            $verif_object = new user;
            $info = $verif_object->check_email($email_forgot);
            $email_verif = "/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i";


            if (!preg_match($email_verif, $email_forgot))
            {
                $result_message = 'Format de l\'adresse e-mail invalide.';
            }
            else if (!$info)
            {
                $result_message = 'L\'adresse e-mail est inexistante.';
            }
            if (empty($result_message))
            {
                $pseudonym = $info['pseudonym'];
                $email = $info['email'];
                $confirm_key = $verif_object->make_confirm_key();

                if ($verif_object->update_confirm_key_password($confirm_key, $pseudonym))
                {
                    if (user::check_confirm_account_key_password($pseudonym) != 0)
                    {
                        user::set_confirm_password_key(0, $pseudonym);
                    }
                    if ($verif_object->send_mail_forgotten_password($pseudonym, $email, $confirm_key))
                    {
                        header("location: http://localhost:8080/Camagru/View/forgot_password_sent.php");
                        exit;
                    }
                    else
                    {
                        $result_message = 'L\'email de réinitialisation de votre mot de passe n\'a pas pu être envoyé';
                    }
                }
                else
                {
                    $result_message = 'Échec de la prise en charge de votre adresse e-mail.';
                }
            }
        }
        else
        {
            $result_message = 'Veuillez remplir le champ.';
        }
    }
    else
    {
        header("location: http://localhost:8080/Camagru/View/404_error.html");
    }
}

?>