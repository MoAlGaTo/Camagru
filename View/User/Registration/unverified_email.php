<?php ob_start();?>


<div id="content">
    <a href="/Camagru/index.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
    <div id="success"><p id="success_p">√ Votre inscription a bien été prise en compte</p></div>
    <h1>Un e-mail de confirmation vous a été envoyé.</h1>
    <p>Avant de pouvoir accéder à votre compte Camagru, veuillez valider votre adresse e-mail.<br/>
    Pensez à vérifier dans vos courrier indésirable.</p>
    <p><a href="/Camagru/index.php">Retour à la page d'accueil</a></p>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_un_al_verified_email.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>