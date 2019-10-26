<?php ob_start();
if (!empty($_GET['pseudo']))
{
    $pseudonym = htmlspecialchars($_GET['pseudo']);
}
?>

<div id="content">
    <img src="../Public/Image/camagru_logo.png">
    <div id="success"><p id="success_p">√ Votre mot de passe a bien été modifié</p></div>
    <h1>La modification a bien été prise en compte <?= $pseudonym?>.</h1>
    <p>Vous pouvez maintenant avoir de nouveau accès à votre compte Camagru.</p>
    <p><a href="http://localhost:8080/Camagru/View/form.php">Retour à la page d'accueil</a></p>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_un_al_verified_email.css";
require("template.php");
?>