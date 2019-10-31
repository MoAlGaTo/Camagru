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
    <li><a class="page" href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/profil_blue.png">Profil</a></li>
    <li><a class="sign_out" href="/Camagru/Controller/Admin/sign_out.php"><img src="/Camagru/Public/Image/logout_red.png">Déconnexion</a></li>
</ul>

<div class="data">
    <h1>Informations personnelles</h1>
    <p class="descript_h1">Informations utilisées pour votre compte Camagru</p>
    <p class="datas"><img src="/Camagru/Public/Image/user.png"><?= $_SESSION['firstname'];?> <?= $_SESSION['lastname'];?></p>
    <p class="datas"><span class="title">Pseudonyme</span><span class="datas_result"><?= $_SESSION['pseudonym'] ?></span></p>
	<p class="datas"><span class="title">E-mail</span><span class="datas_result"><?= $_SESSION['email'] ?></span></p>
	<p class="datas"><span class="title">Mot de passe</span><span class="datas_result">**********</span></p>
	<p class="update_text"><a class="update" href="/Camagru/View/Admin/Profile/info_admin_update.php">Mettre à jour ses informations</a></p>
	<p class="update_text"><a class="update">Modifier son mot de passe</a></p>
</div>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>