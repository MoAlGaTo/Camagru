<?php ob_start();
if (!empty($_GET['pseudo']))
{
    $pseudonym = htmlspecialchars($_GET['pseudo']);
}
else
{
    $pseudonym = NULL;
}
?>

<div id="content">
    <a href="/Camagru/View/form.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
    <div id="failure"><p id="failure_p">✖ Votre e-mail a déjà été verifié</p></div>
    <h1>Votre compte est actif <?= $pseudonym?> .</h1>
    <p>Vous pouvez vous connecter et avoir accès à votre compte Camagru.</p>
    <p><a href="/Camagru/View/form.php">Retourner à la page d'accueil et se connecter</a></p>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_un_al_verified_email.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>