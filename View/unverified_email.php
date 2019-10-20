<?php ob_start();
require_once("../Controller/email_verif.php");?>


<div id="content">
    <img src="../Public/Image/camagru_logo.png">
    <div id="success"><p id="success_p">√ Votre inscription a bien été prise en compte</p></div>
    <h1>Un e-mail de confirmation vous a été envoyé.</h1>
    <p>Avant de pouvoir accéder à votre compte Camagru, veuillez valider votre adresse e-mail.<br/>
    Pensez à vérifier dans vos courrier indésirable.</p>
    <p><a href="form.php">Retour à la page d'accueil</a></p>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_un_al_verified_email.css";
require("template.php");
?>