<?php 
session_start();
if (empty($_SESSION))
{
    header("location: /Camagru/View/form.php");
}
ob_start();
?>

<ul>
    <img class="logo" src="/Camagru/Public/Image/camagru_logo2.png">
    <p class="welcome_message">Bienvenue<br/> <?= $_SESSION['pseudonym'] ?> !</p>
    <li><a href="/Camagru/View/Admin/home_page.php"><img src="/Camagru/Public/Image/home_white.png">Accueil</a></li>
    <li><a class="page" href="/Camagru/View/Admin/my_gallery.php"><img src="/Camagru/Public/Image/mygallery_blue.png">Ma galerie</a></li>
    <li><a href="/Camagru/View/Admin/take_pictures.php"><img src="/Camagru/Public/Image/takepicture_white.png">Photo</a></li>
    <li><a href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/profil_white.png">Profil</a></li>
    <li><a class="sign_out" href="/Camagru/Controller/Admin/sign_out.php"><img src="/Camagru/Public/Image/logout_red.png">Déconnexion</a></li>
</ul>

<?php
if (session_status() === PHP_SESSION_NONE)
{
    echo 'NONE';
}
else if (session_status() === PHP_SESSION_ACTIVE)
{
    echo 'ACTIVE';
}
else if ( session_status() === PHP_SESSION_DISABLED)
{
    echo 'DISABLED';
}
echo '<br/>';
echo "Selem Aleykoum ".$_SESSION['pseudonym']." !";
echo '<br/>';
echo $_SESSION['id_user'];
echo '<br/>';
echo $_SESSION['lastname'];
echo '<br/>';
echo $_SESSION['firstname'];
echo '<br/>';
echo $_SESSION['pseudonym'];
echo '<br/>';
echo $_SESSION['email'];
echo '<br/>';
//session_destroy();
if (session_status() === PHP_SESSION_NONE)
{
    echo 'NONE';
}
else if (session_status() === PHP_SESSION_ACTIVE)
{
    echo 'ACTIVE';
}
else if ( session_status() === PHP_SESSION_DISABLED)
{
    echo 'DISABLED';
}

$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>