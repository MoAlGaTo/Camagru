<?php ob_start();
require_once("../Model/DB_users");

if (isset($_GET['pseudonym']) && isset($_GET['confirm_key']))
{
    $pseudonym = htmlspecialchars($_GET['pseudonym']);
    $confirm_key = htmlspecialchars($_GET['confirm_key']);
}

$pseudo_exist = new user;
$confirm_key_exist = new user;

//if ($pseudo_exist->check_pseudo($pseudonym) > 0 && $pseudo_exist->check_pseudo($pseudonym) > 0 fonction de cle a 0 ou 1)
?>

<div id="content">
    <img src="../Public/Image/camagru_logo.png">
    <div id="success"><p id="success_p">√ Votre e-mail a bien été verifié</p></div>
    <h1>Félicitations <?= $pseudonym?> !</h1>
    <p>Vous pouvez maintenant avoir accès à votre compte Camagru.</p>
    <p><a href="form.php">Retourner à la page d'accueil et se connecter</a></p>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_un_verified_email.css";
require("template.php");
?>