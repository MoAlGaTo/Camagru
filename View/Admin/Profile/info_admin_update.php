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
$authentication = false;
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Admin/Updating/info_admin_checking.php")
?>

<a href="/Camagru/View/Admin/Profile/profile_admin.php"><p class="welcome_message"><img class="img_admin" src="/Camagru/Public/Image/admin.png"><?= $_SESSION['pseudonym'] ?></p>
<div class="profil"></a>
<ul>
    <a href="/Camagru/View/Admin/home_page.php"><img class="logo" src="/Camagru/Public/Image/camagru_logo2.png"></a>
    <li><a href="/Camagru/View/Admin/home_page.php"><img src="/Camagru/Public/Image/home_black.png">Accueil</a></li>
    <li><a href="/Camagru/View/Admin/my_gallery.php"><img src="/Camagru/Public/Image/mygallery_black.png">Ma galerie</a></li>
    <li><a href="/Camagru/View/Admin/take_pictures.php"><img src="/Camagru/Public/Image/takepicture_black.png">Photo</a></li>
    <li><a class="page" href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/profil_blue.png">Profil</a></li>
    <li><a class="sign_out" href="/Camagru/Controller/Admin/sign_out.php"><img class="sign_out_img" src="/Camagru/Public/Image/logout.png">Déconnexion</a></li>
</ul>


<?php if ($authentication) {?>

<!-- modification information -->
<section class="update_info">
    <form class="formsignup formmarg" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <a class="form_link" href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
        <p>Mettre à jour ses informations</p>
        <input type="text" name="lastname" id="lastname" value="<?= $_SESSION['lastname']?>" placeholder="Nom" />
        <?php if (isset($lastname_message_alert)) { ?> <p class="alert_message"><?= $lastname_message_alert; ?></p><?php } ?>
        <input type="text" name="firstname" id="firstname" value="<?= $_SESSION['firstname']?>" placeholder="Prénom" />
        <?php if (isset($firstname_message_alert)) { ?> <p class="alert_message"><?= $firstname_message_alert; ?></p><?php } ?>
        <input type="text" name="pseudonym" id="pseudonym" value="<?= $_SESSION['pseudonym']?>" placeholder="Pseudonyme">
        <?php if (isset($pseudo_message_alert)) { ?> <p class="alert_message"><?= $pseudo_message_alert; ?></p><?php } ?>
        <?php if (isset($pseudo_exist_message_alert)) { ?> <p class="alert_message"><?= $pseudo_exist_message_alert; ?></p><?php } ?>
        <input type="email" name="email" id="email" value="<?= $_SESSION['email']?>" placeholder="E-mail">
        <?php if (isset($email_message_alert)) { ?> <p class="alert_message"><?= $email_message_alert; ?></p><?php } ?>
        <?php if (isset($email_exist_message_alert)) { ?> <p class="alert_message"><?= $email_exist_message_alert; ?></p><?php } ?>
        <h4 class="h4-info-modif">Recevoir une notification par e-mail lorsqu'un commentaire est posté sur ma photo :</h4>
        <div class="checkbox">
            <label class="radio-btn yes">Oui
                <input class="radio" type="radio"<?php if ($_SESSION['receive_notif'] == 1) {?> checked="checked"<?php } ?> name="radio" value="yes">
            </label>
            <label class="radio-btn">Non
                <input class="radio last_input" <?php if ($_SESSION['receive_notif'] == 0) {?> checked="checked"<?php } ?> type="radio" name="radio" value="no">
            </label>
        </div>
        <?php if (isset($empty_message_alert)) { ?> <p class="alert_message"><?= $empty_message_alert; ?></p><?php } ?>
        <?php if (isset($result_message)) { ?> <p class="alert_message"><?= $result_message; ?></p><?php } ?>
        <button class="button" type="submit" name="update_butt">Modifier</button>
    </form>
</section>
</div>

<?php } else {?>

<!-- Entrez mot de passe -->
<section class="update_info">
    <form class="formsignup" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <a href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
        <p class="actual_pass">Entrez votre mot de passe actuel</p>
        <input class="last_input" type="password" name="password" id="password" placeholder="Mot de passe">
        <?php if (isset($result_pass_message)){?> <p class="alert_message"><?=$result_pass_message;?></p><?php }?>
        <button class="button" type="submit" name="valid_butt">Valider</button>
    </form>
<section>
<?php }?>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>