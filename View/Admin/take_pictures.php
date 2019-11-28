<?php
session_start();
if (empty($_SESSION))
{
    header("location: /Camagru/index.php");
    die();
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


<video id="video" width="500" height="400"></video>
<div class="takepicture-container">
    <div id="takePicture">
            <button id="startCameraButton" class="green-btn">Activer la webcam</button>
            <canvas id="canvas" width="500" height="400"></canvas>
            <hr />
            <div id="div-button">
                <button id="takePicture-button" class="tp-btn"><img class="tp-btn-img" src="/Camagru/Public/Image/button.png"></button>
            </div>
            <button id="clean-canvas" class="tp-btn"><img class="tp-btn-img" src="/Camagru/Public/Image/canvas_cleaner.png"></button>
            <form id="form-upld-img" method="POST" enctype="multipart/form-data" action="">
                <label for="upload-img" class="btn-upld">Télécharger une image</label>
                <input type="file" style="visibility:hidden;" name="file" id="upload-img">
            </form>
        <ul id="filters">
            <?php
            $filters = scandir($_SERVER['DOCUMENT_ROOT'] . '/Camagru/Public/Image/Filters');
            $idIndex = 1;

            foreach ($filters as $filter) {
                $type = explode('.', $filter);
                if ($type[1] == 'png') { ?>
                    <li><img onclick="addFilter(<?= $idIndex ?>)" class="filter" id="<?= $idIndex ?>" src="/Camagru/Public/Image/Filters/<?= $filter ?>"></li>
            <?php $idIndex++;
                }
            } ?>
        </ul>
        <button id="clear-filters" class="red-btn">Retirer tout les filtres</button>
    </div>
    <div id="photos-block">
        <button id="clear-button" class="tp-btn clean-btn"><img class="tp-btn-img" src="/Camagru/Public/Image/clean_up.png"></button>
        <div id="photos"></div>
    </div>
</div>
<script src="/Camagru/Public/JavaScript/camera.js"></script>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT'] . "/Camagru/View/template.php");
?>