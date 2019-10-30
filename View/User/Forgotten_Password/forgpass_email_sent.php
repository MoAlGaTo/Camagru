<?php ob_start();?>


<div id="content">
    <a href="/Camagru/View/form.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
    <div id="success"><p id="success_p">√ Votre adresse e-mail a bien été identifié</p></div>
    <h1>Un e-mail de réinitialisation vous a été envoyé.</h1>
    <p>Avant de pouvoir modifier votre mot de passe et accéder de nouveau à votre compte Camagru, veuillez cliquez sur le lien réinitialisation envoyé par e-mail.<br/>
    Pensez à vérifier dans vos courrier indésirable.</p>
    <p><a href="/Camagru/View/form.php">Retour à la page d'accueil</a></p>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_un_al_verified_email.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>