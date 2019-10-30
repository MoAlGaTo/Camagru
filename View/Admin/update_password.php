<?php
ob_start();
if (empty($_SESSION))
{
    header("location: /Camagru/View/form.php");
}
session_start();
// Message d'erreurs modification mot de passe
$password_message_alert = NULL;
$password_confirm_message_alert = NULL;
$password_exist_message_alert = NULL;
$result_message = NULL;
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Admin/Updating/update_password_verif.php");
?>

<!-- modification mot de passe -->
<section class="update_info">
    <form class="formsignup" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <a href="/Camagru/View/form.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
        <p>Modifier son mot de passe</p>
        <input type="password" name="password" id="password" placeholder="Nouveau mot de passe">
        <?php if (isset($password_message_alert)){?> <p class="alert_message"><?=$password_message_alert;?></p><?php }?>
        <input class="last_input" type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe">
        <?php if (isset($password_confirm_message_alert)){?> <p class="alert_message"><?=$password_confirm_message_alert;?></p><?php }?>
        <?php if (isset($empty_message_alert)){?> <p class="alert_message"><?=$empty_message_alert;?></p><?php }?>
        <?php if (isset($result_message)){?> <p class="alert_message"><?=$result_message;?></p><?php }?>
        <button class="button" type="submit" name="modif_butt">Modifier</button>
    </form>
<section>

<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>