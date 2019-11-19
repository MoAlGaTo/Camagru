<?php 
session_start();
if (empty($_SESSION))
{
    header("location: /Camagru/View/form.php");
}
ob_start();
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_pictures.php");
?>

<a href="/Camagru/View/Admin/Profile/profile_admin.php"><p class="welcome_message"><img class="img_admin" src="/Camagru/Public/Image/admin.png"><?= $_SESSION['pseudonym'] ?></p>
<div class="profil"></a>
<ul>
    <a href="/Camagru/View/Admin/home_page.php"><img class="logo" src="/Camagru/Public/Image/camagru_logo2.png"></a>
    <li><a href="/Camagru/View/Admin/home_page.php"><img src="/Camagru/Public/Image/home_black.png">Accueil</a></li>
    <li><a class="page" href="/Camagru/View/Admin/my_gallery.php"><img src="/Camagru/Public/Image/mygallery_blue.png">Ma galerie</a></li>
    <li><a href="/Camagru/View/Admin/take_pictures.php"><img src="/Camagru/Public/Image/takepicture_black.png">Photo</a></li>
    <li><a href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/profil_black.png">Profil</a></li>
    <li><a class="sign_out" href="/Camagru/Controller/Admin/sign_out.php"><img class="sign_out_img" src="/Camagru/Public/Image/logout.png">Déconnexion</a></li>
</ul>


<div id="my-photos">
    <?php
        $allPictures = picture::get_user_pictures($_SESSION['id_user']);
        foreach ($allPictures as $picture)
        {?>
        <div>
            <img src=<?= $picture[1]; ?> id=" <?= $picture[0] ?>">
            <button id="<?= $picture[0] ?>" class="btn">Supprimer</button>
        </div>
        <?php }?>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>