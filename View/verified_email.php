<?php ob_start();
require_once("../Controller/email_verif.php");?>

<div id="content">
<img src="../Public/Image/camagru_logo.png">
<div id="success"><p id="success_p">√ Votre e-mail a bien été verifié</p></div>
<h1>Félicitations <?= $pseudonym?> !</h1>
<p>Vous pouvez maintenant avoir accès à votre compte Camagru.</p>
<p><a href="form.php">Retourner à la page d'accueil et se connecter</a></p>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_un_al_verified_email.css";
require("template.php");
?>