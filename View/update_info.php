<?php ob_start();
require_once("../Controller/update_info_verif.php")
?>

<!-- modification information -->
<section class="update_info">
    <form class="formsignup formmarg" method="POST" action="./update_info.php">
        <img src="../Public/Image/camagru_logo.png">
        <p>Mettre à jour ses informations</p>
        <input type="text" name="lastname" id="lastname" value="<? $_SESSION['lastname']?>" placeholder="Nom" />
        <?php if (isset($lastname_message_alert)) { ?> <p class="alert_message"><?= $lastname_message_alert; ?></p><?php } ?>
        <input type="text" name="firstname" id="firstname" value="<? $_SESSION['firstname']?>" placeholder="Prénom" />
        <?php if (isset($firstname_message_alert)) { ?> <p class="alert_message"><?= $firstname_message_alert; ?></p><?php } ?>
        <input type="text" name="pseudonym" id="pseudonym" value="<? $_SESSION['pseudonym']?>" placeholder="Pseudonyme">
        <?php if (isset($pseudo_message_alert)) { ?> <p class="alert_message"><?= $pseudo_message_alert; ?></p><?php } ?>
        <?php if (isset($pseudo_exist_message_alert)) { ?> <p class="alert_message"><?= $pseudo_exist_message_alert; ?></p><?php } ?>
        <input class="last_input" type="email" name="email" id="email" value="<? $_SESSION['email']?>" placeholder="E-mail">
        <?php if (isset($email_message_alert)) { ?> <p class="alert_message"><?= $email_message_alert; ?></p><?php } ?>
        <?php if (isset($email_exist_message_alert)) { ?> <p class="alert_message"><?= $email_exist_message_alert; ?></p><?php } ?>
        <?php if (isset($empty_message_alert)) { ?> <p class="alert_message"><?= $empty_message_alert; ?></p><?php } ?>
        <?php if (isset($result_message)) { ?> <p class="alert_message"><?= $result_message; ?></p><?php } ?>
        <button class="button" type="submit" name="update_butt" value='inscription_btn'>Modifier</button>
    </form>
</section>

<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require("template.php");?>