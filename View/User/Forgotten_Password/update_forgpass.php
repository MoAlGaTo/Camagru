<?php 
session_start();
ob_start();
if (!empty($_SESSION))
{
	header("location: /Camagru/View/Admin/home_page.php");
	die();
}
// Message d'erreurs modification mot de passe
$password_message_alert = NULL;
$password_confirm_message_alert = NULL;
$empty_message_alert = NULL;
$result_message = NULL;

// // Sauvegarde informations entrees
$temporary_modif_password = NULL;
$temporary_confirm_modif_password = NULL;

if (!empty($_GET['pseudo']) && !empty($_GET['key']))
{
    $pseudonym = htmlspecialchars($_GET['pseudo']);
    $confirm_key = htmlspecialchars($_GET['key']);
}
else
{
    $pseudonym = NULL;
    $confirm_key = NULL;
}
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Forgotten_Password/update_forgpass_checking.php");
?>
<!-- modification mot de passe -->
<section class="update_info">
    <form class="formsignup" method="POST" action="<?=$_SERVER['PHP_SELF'].'?pseudo='.$pseudonym.'&key='.$confirm_key;?>">
        <a href="/Camagru/index.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
        <p>Modifier votre mot de passe</p>
        <input type="password" name="password" id="password" placeholder="Nouveau mot de passe" <?php if (isset($temporary_modif_password)) {?> value="<?= $temporary_modif_password ?>" <?php  }?>>
        <?php if (isset($password_message_alert)){?> <p class="alert_message"><?=$password_message_alert;?></p><?php }?>
        <input class="last_input" type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe" <?php if (isset($temporary_confirm_modif_password)) {?> value="<?= $temporary_confirm_modif_password ?>" <?php  }?>>
        <?php if (isset($password_confirm_message_alert)){?> <p class="alert_message"><?=$password_confirm_message_alert;?></p><?php }?>
        <?php if (isset($empty_message_alert)){?> <p class="alert_message"><?=$empty_message_alert;?></p><?php }?>
        <?php if (isset($result_message)){?> <p class="alert_message"><?=$result_message;?></p><?php }?>
        <button class="button" type="submit" name="modif_butt">Modifier</button>
        <p class="mdpf"><a href="/Camagru/index.php">Retour à la page d'accueil</a></p>
    </form>
<section>

<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>