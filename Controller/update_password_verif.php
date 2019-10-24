<?php
require_once("../Model/DB_users.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if (isset($_POST['modif_butt']))
    {
        $password_verif = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*(),.;?\":{}\[\]|<>])(?=.{6,50}$)/";

        if (!empty($_POST['password']) && !empty($_POST['password_confirm']))
        {
            $passworduser = htmlspecialchars($_POST['password']);
            $passworduser_confirm = htmlspecialchars($_POST['password_confirm']);
            $id = $_SESSION['id_user'];	
            
            if (!preg_match($password_verif, $passworduser))
            {
                $password_message_alert = "Votre mot de passe doit contenir 6 caractère minimum et 50 caractères maximum, et au moins 1 majuscule, 1 chiffre et 1 caractère spécial (ex: \"!\", \"\$\", \"&\", \".\", \"%\", \"*\", \"@\", etc ...)";
            }
            if (!($passworduser === $passworduser_confirm))
            {
                $password_confirm_message_alert = "Le mot de passe ne correspond pas.";
            }

            $passworduser = hash('sha256', $passworduser);

            if ((user::check_password($id)) === $passworduser)
            {
                $password_exist_message_alert = "Votre mot de passe correspond à l'ancien. Veuillez le modifer.";
            }
            if (empty($password_message_alert) && empty($password_confirm_message_alert) && empty($password_exist_message_alert))
            {
                if (user::edit_password($passworduser, $id))
                {
                    $result_message = "Votre mot de passe a bien été modifié.";
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
        header("location: http://localhost:8080/Camagru/View/404_error.html");
    }
}

?>