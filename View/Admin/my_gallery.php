<?php 
session_start();
if (empty($_SESSION))
{
    header("location: /Camagru/View/form.php");
}
ob_start();
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_pictures.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Admin/Pictures/delete_picture.php");
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

<div id="my-photos-container">
	<?php
	$result = picture::get_user_pictures($_SESSION['id_user']);
	$totalPictures = $result[0];
	$allPictures = $result[1];
	$totalDisplay = 12;
	if (empty($result[1]))
	{
		$totalPages = 1;
	}
	else
	{
		$totalPages = ceil($totalPictures / $totalDisplay);
	}

	if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > $totalPages)
	{
		$currentPage = $totalPages;
	}
	else if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0)
	{
		$currentPage = intval($_GET['page']);
	}
	else
	{
		$currentPage = 1;
	}
	$start = ($currentPage - 1) * $totalDisplay;
	$limit = $start + $totalDisplay;
	?>
	<div class="pagination top-pag">
		<?php
		echo '<a href="http://localhost:8080/Camagru/View/Admin/my_gallery.php?page=1">&laquo;</a>'; 
		for ($i = 1; $i <= $totalPages; $i++)
		{
			if ($i == $currentPage)
			{
				echo '<a href="http://localhost:8080/Camagru/View/Admin/my_gallery.php?page='.$i.'" class="a-active">'.$i.'</a>';
			}
			else
			{
				echo '<a href="http://localhost:8080/Camagru/View/Admin/my_gallery.php?page='.$i.'">'.$i.'</a>';
			}
		}
		echo '<a href="http://localhost:8080/Camagru/View/Admin/my_gallery.php?page='.$totalPages.'">&raquo;</a>';
		?>
	</div>
	<div id="my-photos">
		<?php
		while ($start < $limit && $start < $totalPictures)
		{
			$picture = $allPictures[$start];
		?>
			<div id="individualPicture">
				<img src=<?= $picture[1] ?> id="<?= $picture[0] ?>" class="img-my-gallery"><hr/>
				<form action="<?=$_SERVER['PHP_SELF'].'?page='.$currentPage;?>" method="POST" class="form-like-comment">
					<input type="hidden" name="delete_picture" value="<?= $picture[0] ?>">
					<button type="submit" name="delete_button" class="btn">Supprimer</button>
				</form>
			</div>
	<?php	$start++; 
			}
		?>
	</div>
	<div class="pagination bottom-pag">
		<?php
			echo '<a href="http://localhost:8080/Camagru/View/Admin/my_gallery.php?page=1">&laquo;</a>';
			for ($i = 1; $i <= $totalPages; $i++)
			{
				if ($i == $currentPage)
				{
					echo '<a href="http://localhost:8080/Camagru/View/Admin/my_gallery.php?page='.$i.'" class="a-active">'.$i.'</a>';
				}
				else
				{
					echo '<a href="http://localhost:8080/Camagru/View/Admin/my_gallery.php?page='.$i.'">'.$i.'</a>';
				}
			}
			echo '<a href="http://localhost:8080/Camagru/View/Admin/my_gallery.php?page='.$totalPages.'">&raquo;</a>';
		?>
	</div>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>