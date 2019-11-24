<?php 
session_start();
if (empty($_SESSION))
{
    header("location: /Camagru/index.php");
}
ob_start();
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_pictures.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_likes.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_comments.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Admin/Likes/add_like.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Admin/Comments/add_comment.php");
?>

<a href="/Camagru/View/Admin/Profile/profile_admin.php"><p class="welcome_message"><img class="img_admin" src="/Camagru/Public/Image/admin.png"><?= $_SESSION['pseudonym'] ?></p>
<div class="profil"></a>
<ul>
    <a href="/Camagru/View/Admin/home_page.php"><img class="logo" src="/Camagru/Public/Image/camagru_logo2.png"></a>
    <li><a class="page" href="/Camagru/View/Admin/home_page.php"><img src="/Camagru/Public/Image/home_blue.png">Accueil</a></li>
    <li><a href="/Camagru/View/Admin/my_gallery.php"><img src="/Camagru/Public/Image/mygallery_black.png">Ma galerie</a></li>
    <li><a href="/Camagru/View/Admin/take_pictures.php"><img src="/Camagru/Public/Image/takepicture_black.png">Photo</a></li>
    <li><a href="/Camagru/View/Admin/Profile/profile_admin.php"><img src="/Camagru/Public/Image/profil_black.png">Profil</a></li>
    <li><a class="sign_out" href="/Camagru/Controller/Admin/sign_out.php"><img class="sign_out_img" src="/Camagru/Public/Image/logout.png">Déconnexion</a></li>
</ul>

<?php
$result_likes = like::get_likes();

$result = picture::get_pictures();
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

<div id="all-pages">
	<div id="my-photos-container-2">
		<div class="pagination top-pag">
			<?php
			echo '<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page=1">&laquo;</a>'; 
			for ($i = 1; $i <= $totalPages; $i++)
			{
				if ($i == $currentPage)
				{
					echo '<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page='.$i.'" class="a-active">'.$i.'</a>';
				}
				else
				{
					echo '<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page='.$i.'">'.$i.'</a>';
				}
			}
			echo '<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page='.$totalPages.'">&raquo;</a>';
			?>
		</div>
		<div id="my-photos-2">
			<?php
			while ($start < $limit && $start < $totalPictures)
			{
				$picture = $allPictures[$start];
				$likes_number = 0;
			?>
				<div id="individualPicture-2">
					<img src=<?= $picture[1] ?> id="<?= $picture[0] ?>" class="img-home-page"><hr/>
					<?php
						$already_liked = false;
						foreach ($result_likes as $like)
						{
							if ($like[2] == $picture[0])
							{
								if ($like[1] == $_SESSION['id_user'])
								{
									$already_liked = true;
								}
								$likes_number++;
							}
						}
					?>
					<div id="like-comment">
						<form action="<?=$_SERVER['PHP_SELF'].'?page='.$currentPage;?>" method="POST" class="form-like-comment">
							<input type="hidden" name="add_like" value="<?= $picture[0] ?>">
							<input type="image" <?php if ($already_liked) { ?> src='/Camagru/Public/Image/love.png' <?php } else { ?> src='/Camagru/Public/Image/love_black.png' onmouseout="this.src='/Camagru/Public/Image/love_black.png';" onmouseover="this.src='/Camagru/Public/Image/love.png';"<?php } ?> class="like" type="submit"/>
						</form>

						<p class="like-phrase"><?= $likes_number ?><span class="like-word">j'aime</span></p>

						<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page=<?= $currentPage; ?>&picture_comments=<?= $picture[0] ?>"><img <?php if (isset($_GET['picture_comments']) && $_GET['picture_comments'] == $picture[0]) {?> src='/Camagru/Public/Image/comment-black-oval-bubble-shape.png'<?php } else {?> src='/Camagru/Public/Image/comment-white-oval-bubble.png' onmouseover="this.src='/Camagru/Public/Image/comment-black-oval-bubble-shape.png';" onmouseout="this.src='/Camagru/Public/Image/comment-white-oval-bubble.png';" <?php }?> class="like comment-word"></a>
					</div>
				</div>
		<?php	$start++; 
				}
			?>
		</div>
		<div class="pagination bottom-pag">
			<?php
				echo '<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page=1">&laquo;</a>';
				for ($i = 1; $i <= $totalPages; $i++)
				{
					if ($i == $currentPage)
					{
						echo '<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page='.$i.'" class="a-active">'.$i.'</a>';
					}
					else
					{
						echo '<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page='.$i.'">'.$i.'</a>';
					}
				}
				echo '<a href="http://localhost:8080/Camagru/View/Admin/home_page.php?page='.$totalPages.'">&raquo;</a>';
			?>
		</div>
	</div>
	<div id="comments">
		<h1 id="comments-h1">Commentaires</h1><br/><p id="comments-description">Cliquez sur l'icone commentaire d'une image</p><hr/>
		<div id="display-comments">
		<?php
		if (isset($_GET['picture_comments']) && !empty($_GET['picture_comments']) && $_GET['picture_comments'] > 0)
		{
			$id_picture_get_comments = intval($_GET['picture_comments']);

			$count = 1;
			$max = false;

			foreach ($allPictures as $picture)
			{
				
				if ($picture['id_picture'] == $id_picture_get_comments)
				{
					$max = true;
					$location = $count;
				}
				$count++;
			}
			if ($max)
			{
				$location = ceil($location / 12);
				if ($location != $currentPage)
				{
					header('location: http://localhost:8080/Camagru/View/Admin/home_page.php?page='.$location.'&picture_comments='.$id_picture_get_comments);
				}
				$result_comments = comment::get_comments($id_picture_get_comments);
	
				if ($result_comments[0])
				{
					$all_picture_comments = $result_comments[1];
					foreach ($all_picture_comments as $picture_comment)
					{
						$user = comment::get_user($picture_comment[1]);
						$user = $user[3];
						$date = $picture_comment[4];
						$comment = $picture_comment[3];
					?>
						<h4><?= $user ?>, <?= $date ?>.</h4>
						<p class="comment-display"><?= $comment ?></p>
				<?php
					}
				}
				else
				{?>
					<h2>Aucun commentaire</h2>
					<?php
				}?>
				</div>
				<form action="<?=$_SERVER['PHP_SELF'].'?page='.$currentPage;?>&picture_comments=<?= $id_picture_get_comments ?>" method="POST" id="add-comment-form">
					<input type="hidden" name="picture" value="<?= $id_picture_get_comments ?>">
					<textarea name="comment" placeholder="Écrire un commentaire(200 caractères maximum)..." maxlength="200"></textarea>
					<button type="submit" name="add_comment" class="btn add-comment">Ajouter</button>
				</form>
		<?php
			}
		}
		?>
	</div>
</div>

<?php
$content = ob_get_clean();
$css_link = "style_admin_page.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>