<?php
session_start();
if (empty($_SESSION)) {
    header("location: /Camagru/View/form.php");
}
ob_start();
?>

<a href="/Camagru/View/Admin/Profile/profile_admin.php">
    <p class="welcome_message"><img class="img_admin" src="/Camagru/Public/Image/admin.png"><?= $_SESSION['pseudonym'] ?></p>
    <div class="profil">
</a>
<ul>
    <a href="/Camagru/View/Admin/home_page.php"><img class="logo" src="/Camagru/Public/Image/camagru_logo2.png"></a>
    <li><a href="/Camagru/View/Admin/home_page.php"><img src="/Camagru/Public/Image/home_black.png">Accueil</a></li>
    <li><a href="/Camagru/View/Admin/my_gallery.php"><img src="/Camagru/Public/Image/mygallery_black.png">Ma galerie</a></li>
    <li><a class="page" href="/Camagru/View/Admin/take_pictures.php"><img src="/Camagru/Public/Image/takepicture_blue.png">Photo</a></li>
    <li><a href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/profil_black.png">Profil</a></li>
    <li><a class="sign_out" href="/Camagru/Controller/Admin/sign_out.php"><img class="sign_out_img" src="/Camagru/Public/Image/logout.png">Déconnexion</a></li>
</ul>


<video id="video" width="0" height="0"></video>
<div class="takepicture-container">
    <div id="takePicture">
        <canvas id="canvas" width="400" height="300">Caméra non disponible...</canvas>
        <button id="takePicture-button" class="btn">Prendre une photo</button>
        <button id="clear-button" class="btn">Tout effacer</button>
    </div>
    <div id="photos"></div>
</div>
<script src="/Camagru/Public/JavaScript/camera.js"></script>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT'] . "/Camagru/View/template.php");
?>