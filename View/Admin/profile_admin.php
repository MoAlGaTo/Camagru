<?php 
session_start();
if (empty($_SESSION))
{
    header("location: /Camagru/View/form.php");
}
ob_start();
?>

<div class="profil">
<ul>
    <img class="logo" src="/Camagru/Public/Image/camagru_logo2.png">
    <p class="welcome_message">Bienvenue<br/> <?= $_SESSION['pseudonym'] ?> !</p>
    <li><a href="/Camagru/View/Admin/home_page.php"><img src="/Camagru/Public/Image/home_white.png">Accueil</a></li>
    <li><a href="/Camagru/View/Admin/my_gallery.php"><img src="/Camagru/Public/Image/mygallery_white.png">Ma galerie</a></li>
    <li><a href="/Camagru/View/Admin/take_pictures.php"><img src="/Camagru/Public/Image/takepicture_white.png">Photo</a></li>
    <li><a class="page" href="/Camagru/View/Admin/profile_admin.php"><img src="/Camagru/Public/Image/profil_blue.png">Profil</a></li>
    <li><a class="sign_out" href="/Camagru/Controller/Admin/sign_out.php"><img src="/Camagru/Public/Image/logout_red.png">Déconnexion</a></li>
</ul>

<ul class="datas">
    <li>Mes informations</li>
    <li>Mettre à jour mes informations</li>
    <li>Mettre à jour mon mot de passe</li>
</ul>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>