<?php
session_start();
ob_start();
if (empty($_SESSION))
{
    header("location: /Camagru/index.php");
}
// Message d'erreurs modification mot de passe
$password_message_alert = NULL;
$password_confirm_message_alert = NULL;
$password_exist_message_alert = NULL;
$empty_message_alert = NULL;
$result_message = NULL;
$result_pass_message = NULL;
$authentication = false;
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Admin/Updating/update_password_checking.php");
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

<!-- modification mot de passe -->
<section class="update_info">
    <form class="formsignup" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <a href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
        <p>Modifier son mot de passe</p>
        <input type="password" name="password" id="password" placeholder="Nouveau mot de passe">
        <?php if (isset($password_message_alert)){?> <p class="alert_message"><?=$password_message_alert;?></p><?php }?>
        <input class="last_input" type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe">
        <?php if (isset($password_confirm_message_alert)){?> <p class="alert_message"><?=$password_confirm_message_alert;?></p><?php }?>
        <?php if (isset($password_exist_message_alert)){?> <p class="alert_message"><?=$password_exist_message_alert;?></p><?php }?>
        <?php if (isset($empty_message_alert)){?> <p class="alert_message"><?=$empty_message_alert;?></p><?php }?>
        <?php if (isset($result_message)){?> <p class="alert_message"><?=$result_message;?></p><?php }?>
        <button class="button" type="submit" name="modif_butt">Modifier</button>
    </form>
<section>

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