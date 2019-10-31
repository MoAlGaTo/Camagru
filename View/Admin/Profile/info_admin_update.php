<?php 
session_start();
if (empty($_SESSION))
{
    header("location: /Camagru/View/form.php");
}
ob_start();
$empty_message_alert = NULL;
$lastname_message_alert = NULL;
$firstname_message_alert = NULL;
$pseudo_message_alert = NULL;
$email_message_alert = NULL;
$pseudo_exist_message_alert = NULL;
$email_exist_message_alert = NULL;
$result_message = NULL;
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Admin/Updating/info_admin_checking.php")
?>

<div class="profil">
<ul>
    <img class="logo" src="/Camagru/Public/Image/camagru_logo2.png">
    <p class="welcome_message">Bienvenue<br/> <?= $_SESSION['pseudonym'] ?> !</p>
    <li><a href="/Camagru/View/Admin/home_page.php"><img src="/Camagru/Public/Image/home_white.png">Accueil</a></li>
    <li><a href="/Camagru/View/Admin/my_gallery.php"><img src="/Camagru/Public/Image/mygallery_white.png">Ma galerie</a></li>
    <li><a href="/Camagru/View/Admin/take_pictures.php"><img src="/Camagru/Public/Image/takepicture_white.png">Photo</a></li>
    <li><a class="page" href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/profil_blue.png">Profil</a></li>
    <li><a class="sign_out" href="/Camagru/Controller/Admin/sign_out.php"><img src="/Camagru/Public/Image/logout_red.png">Déconnexion</a></li>
</ul>

<!-- modification information -->
<section class="update_info">
    <form class="formsignup formmarg" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <a class="form_link" href="/Camagru/View/form.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
        <p>Mettre à jour ses informations</p>
        <input type="text" name="lastname" id="lastname" value="<?= $_SESSION['lastname']?>" placeholder="Nom" />
        <?php if (isset($lastname_message_alert)) { ?> <p class="alert_message"><?= $lastname_message_alert; ?></p><?php } ?>
        <input type="text" name="firstname" id="firstname" value="<?= $_SESSION['firstname']?>" placeholder="Prénom" />
        <?php if (isset($firstname_message_alert)) { ?> <p class="alert_message"><?= $firstname_message_alert; ?></p><?php } ?>
        <input type="text" name="pseudonym" id="pseudonym" value="<?= $_SESSION['pseudonym']?>" placeholder="Pseudonyme">
        <?php if (isset($pseudo_message_alert)) { ?> <p class="alert_message"><?= $pseudo_message_alert; ?></p><?php } ?>
        <?php if (isset($pseudo_exist_message_alert)) { ?> <p class="alert_message"><?= $pseudo_exist_message_alert; ?></p><?php } ?>
        <input class="last_input" type="email" name="email" id="email" value="<?= $_SESSION['email']?>" placeholder="E-mail">
        <?php if (isset($email_message_alert)) { ?> <p class="alert_message"><?= $email_message_alert; ?></p><?php } ?>
        <?php if (isset($email_exist_message_alert)) { ?> <p class="alert_message"><?= $email_exist_message_alert; ?></p><?php } ?>
        <?php if (isset($empty_message_alert)) { ?> <p class="alert_message"><?= $empty_message_alert; ?></p><?php } ?>
        <?php if (isset($result_message)) { ?> <p class="alert_message"><?= $result_message; ?></p><?php } ?>
        <button class="button" type="submit" name="update_butt">Modifier</button>
    </form>
</section>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>