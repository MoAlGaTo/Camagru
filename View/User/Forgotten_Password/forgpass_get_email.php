<?php ob_start();
 $result_message = NULL;
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Forgotten_Password/forgpass_email_checking.php");
?>

<!-- mot de passe de passe oublié -->
<section class="update_info">
    <form class="formsignup" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <a href="/Camagru/View/form.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
        <p>Mot de passe oublié</p>
        <input class="last_input" type="email" name="email" id="email" placeholder="Entrez l'adresse e-mail de votre compte">
        <?php if (isset($result_message)){?> <p class="alert_message"><?=$result_message;?></p><?php }?>
        <button class="button" type="submit" name="modif_butt">Envoyer</button>
        <p class="mdpf"><a href="/Camagru/View/form.php">Retour à la page d'accueil</a></p>
    </form>
<section>

<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>