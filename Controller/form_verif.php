<?php
require_once("../View/form.php");
require_once("../Model/DB_users.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['inscription_butt']))
    {
        $name_verif = "/^[^!@#$%^&*(),.;?\":{}\[\]|<>0-9    ]{1,40}$/";
        $pseudonym_verif = "/^.{1,15}$/";
        $email_verif = "/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/i";
        $password_verif = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*(),.;?\":{}\[\]|<>])(?=.{6,50}$)/";

        $empty_message_alert = NULL;
        $lastname_message_alert = NULL;
        $firstname_message_alert = NULL;
        $pseudo_message_alert = NULL;
        $email_message_alert = NULL;
        $password_message_alert = NULL;
        $password_confirm_message_alert = NULL;
        $pseudo_exist_message_alert = NULL;
        $email_exist_message_alert = NULL;
        $failure_message = NULL;

        $add_user_object = new user;

        if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['pseudonym']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm']))
        {
            $lastname = htmlspecialchars($_POST['lastname']);
            $firstname = htmlspecialchars($_POST['firstname']);
            $pseudonym = htmlspecialchars($_POST['pseudonym']);
            $email = htmlspecialchars($_POST['email']);
            $passworduser = htmlspecialchars($_POST['password']);
            $passworduser_confirm = htmlspecialchars($_POST['password_confirm']);
            
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
                $key_length = 15;
                $confirm_key = "";

                for ($i = 1; $i < $key_length; $i++)
                {
                    $confirm_key .= mt_rand(0, 9);
                }

                if ($add_user_object->add_user($lastname, $firstname, $pseudonym, $email, $passworduser, $confirm_key))
                {
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=utf8';
                    $mail_subject = "Confirmation de votre compte Camagru";
                    $mail_confirm_message = '
                        <html>
                            <body>
                                <p>
                                Bienvenue ' . $pseudonym . ' ! Vous venez de vous inscrire sur Camagru, et nous vous en remercions. Pour confirmer votre compte, et pouvoir ainsi accéder à votre espace personnel, veuillez cliquer sur lien ci-dessous:<br/><br/><a href="http://localhost:8080/Camagru/Controller/email_verif.php?pseudo=' . urlencode($pseudonym) . '&key=' . urlencode($confirm_key) . '">Cliquez sur ce lien pour confirmer votre compte.</a><br/><br/>
                                Cet e-mail est généré automatiquement. Merci de ne pas y répondre.<br/><br/>
                                L\'équipe Camagru ©.
                                </p>
                            </body>
                        </html>';

                    if (mail($email, $mail_subject, $mail_confirm_message, implode("\r\n", $headers)))
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
    else
    {
        header("location: http://localhost:8080/Camagru/View/404_error.html");
    }
}
