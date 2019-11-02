<?php 
session_start();
if (empty($_SESSION))
{
    header("location: /Camagru/View/form.php");
}
ob_start();
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

<div class="data">
    <h1>Informations personnelles</h1>
    <p class="descript_h1">Informations utilisées pour votre compte Camagru</p>
    <p class="datas"><img src="/Camagru/Public/Image/user.png"><?= $_SESSION['firstname'];?> <?= $_SESSION['lastname'];?><hr /></p>
    <p class="datas"><span class="title">Pseudonyme</span><span class="datas_result"><?= $_SESSION['pseudonym'] ?></span><hr /></p>
	<p class="datas"><span class="title">E-mail</span><span class="datas_result"><?= $_SESSION['email'] ?></span><hr /></p>
	<p class="datas"><span class="title">Mot de passe</span><span class="datas_result">**********</span><hr /></p>
	<p class="update_text update_text_marg"><a class="update" href="/Camagru/View/Admin/Profile/info_admin_update.php">Mettre à jour ses informations</a></p>
	<p class="update_text"><a class="update" class="update" href="/Camagru/View/Admin/Profile/password_admin_update.php">Modifier son mot de passe</a></p>
</div>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>