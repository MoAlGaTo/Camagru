<?php 
session_start();
ob_start();
?>

<ul>
    <img class="logo" src="../Public/Image/camagru_logo2.png">
    <p class="welcome_message">Bienvenue <?= $_SESSION['pseudonym'] ?> !</p>
    <li><a class="page" href=""><img src="../Public/Image/home_blue.png">Accueil</a></li>
    <li><a href=""><img src="../Public/Image/mygallery_white.png">Ma galerie</a></li>
    <li><a href=""><img src="../Public/Image/takepicture_white.png">Photo</a></li>
    <li><a href=""><img src="../Public/Image/profil_white.png">Profil</a></li>
    <li><a class="sign_out" href=""><img src="../Public/Image/logout_red.png">Se déconnecter</a></li>
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
require("template.php");
?>