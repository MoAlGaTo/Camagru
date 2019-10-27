<?php ob_start();
	// Messages d'erreur inscription
	$empty_message_alert = NULL;
	$lastname_message_alert = NULL;
	$firstname_message_alert = NULL;
	$pseudo_message_alert = NULL;
	$email_message_alert = NULL;
	$password_message_alert = NULL;
	$password_confirm_message_alert = NULL;
	$pseudo_exist_message_alert = NULL;
	$email_exist_message_alert = NULL;
	$failure_message = NULL;

	// Mesages d'erreur connexion
	$empty_message_alert_connect = NULL;
	$connector_message_alert = NULL;
	$password_message_alert_connect = NULL;
require_once("../Controller/account_verif.php");

?>


<section id="form">

    <!-- connexion -->
    <form class="formsignup" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
    <a href="http://localhost:8080/Camagru/View/form.php"><img src="../Public/Image/camagru_logo.png"></a>
        <input type="text" name="pseudo_mail" id="pseudo_mail" placeholder="Adresse e-mail ou Pseudonyme"/>
        <?php if (isset($connector_message_alert)){?> <p class="alert_message"><?=$connector_message_alert;?></p><?php }?>
        <input class="last_input" type="password" name="password_user" id="password_user" placeholder="Mot de passe"/>
        <?php if (isset($password_message_alert_connect)){?> <p class="alert_message"><?=$password_message_alert_connect;?></p><?php }?>
        <?php if (isset($empty_message_alert_connect)){?><p class="alert_message"><?=$empty_message_alert_connect;?></p><?php }?>
        <button class="button fbutton" type="submit" name="connexion_butt">Se Connecter</button>
       <p class="mdpf"><a href="http://localhost:8080/Camagru/View/forgotten_password.php">Mot de passe oublié ?</a></p>
    </form>

    <!-- inscription -->
    <form class="formsignup formmarg" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <p>Pas encore de compte ? Inscrivez-vous pour voir les photos montages de vos amis.</p>
        <input type="text" name="lastname" id="lastname" placeholder="Nom"/>
        <?php if (isset($lastname_message_alert)){?> <p class="alert_message"><?=$lastname_message_alert;?></p><?php }?>
        <input type="text" name="firstname" id="firstname" placeholder="Prénom"/>
        <?php if (isset($firstname_message_alert)){?> <p class="alert_message"><?=$firstname_message_alert;?></p><?php }?>
        <input type="text" name="pseudonym" id="pseudonym" placeholder="Pseudonyme">
        <?php if (isset($pseudo_message_alert)){?> <p class="alert_message"><?=$pseudo_message_alert;?></p><?php }?>
        <?php if (isset($pseudo_exist_message_alert)){?> <p class="alert_message"><?=$pseudo_exist_message_alert;?></p><?php }?>
        <input type="email" name="email" id="email" placeholder="E-mail">
        <?php if (isset($email_message_alert)){?> <p class="alert_message"><?=$email_message_alert;?></p><?php }?>
        <?php if (isset($email_exist_message_alert)){?> <p class="alert_message"><?=$email_exist_message_alert;?></p><?php }?>
        <input type="password" name="password" id="password" placeholder="Mot de passe">
        <?php if (isset($password_message_alert)){?> <p class="alert_message"><?=$password_message_alert;?></p><?php }?>
        <input class="last_input" type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe">
        <?php if (isset($password_confirm_message_alert)){?> <p class="alert_message"><?=$password_confirm_message_alert;?></p><?php }?>
        <?php if (isset($empty_message_alert)){?> <p class="alert_message"><?=$empty_message_alert;?></p><?php }?>
        <?php if (isset($failure_message)){?> <p class="alert_message"><?=$failure_message;?></p><?php }?>
        <button class="button" type="submit" name="inscription_butt" value='inscription_btn'>S'inscrire</button>
    </form>
</section> 

<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require("template.php");?>