<?php
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_users.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['valid_butt']))
    {
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
    else if (isset($_POST['modif_butt']))
    {
        $authentication = true;
        $password_verif = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*(),.;?\":{}\[\]|<>])(?=.{6,50}$)/";

        if (!empty($_POST['password']) && !empty($_POST['password_confirm']))
        {
            $passworduser = htmlspecialchars($_POST['password']);
            $passworduser_confirm = htmlspecialchars($_POST['password_confirm']);
            $pseudonym = $_SESSION['pseudonym'];	
            
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
                $password_exist_message_alert = "Votre mot de passe correspond à l'ancien. Veuillez le modifer.";
            }
            if (empty($password_message_alert) && empty($password_confirm_message_alert) && empty($password_exist_message_alert))
            {
                if (user::edit_password($passworduser, $pseudonym))
                {
                    $_SESSION['passworduser'] = $passworduser;
                    header("location: /Camagru/View/Admin/Profile/profile_admin.php?pc=1");
                    exit;
                }
                else
                {
                    $result_message = "Échec de la modification de votre mot de passe.";
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
    }
}

?>