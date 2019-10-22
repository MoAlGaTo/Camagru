<?php ob_start();

?>

<!-- modification mot de passe -->
<section class="update_info">
    <form class="formsignup" method="POST" action="./update_password.php">
        <img src="../Public/Image/camagru_logo.png">
        <p>Modifier son mot de passe</p>
        <input type="password" name="password" id="password" placeholder="Nouveau mot de passe">
        <?php if (isset($password_message_alert)){?> <p class="alert_message"><?=$password_message_alert;?></p><?php }?>
        <input class="last_input" type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe">
        <?php if (isset($password_confirm_message_alert)){?> <p class="alert_message"><?=$password_confirm_message_alert;?></p><?php }?>
        <?php if (isset($empty_message_alert)){?> <p class="alert_message"><?=$empty_message_alert;?></p><?php }?>
        <?php if (isset($result_message)){?> <p class="alert_message"><?=$result_message;?></p><?php }?>
        <button class="button" type="submit" name="modif_butt" value='inscription_btn'>Modifier</button>
<section>

<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require("template.php"); ?>