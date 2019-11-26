<?php
session_start();
ob_start();
if (!empty($_SESSION))
{
	header("location: /Camagru/View/Admin/home_page.php");
	die();
}
// Messages d'erreur inscription
$empty_message_alert = NULL;
$lastname_message_alert = NULL;
$firstname_message_alert = NULL;
$pseudo_message_alert = NULL;
$email_message_alert = NULL;
$password_message_alert = NULL;
$password_confirm_message_alert = NULL;
$pseudo_exist_message_alert = NULL;
$email_exist_message_alert = NULL;
$failure_message = NULL;

// Mesages d'erreur connexion
$empty_message_alert_connect = NULL;
$connector_message_alert = NULL;
$password_message_alert_connect = NULL;

// Sauvegarde informations entrees
$temporary_connector = NULL;
$temporary_password_connector = NULL;

$temporary_lastname = NULL;
$temporary_firstname = NULL;
$temporary_pseudonym = NULL;
$temporary_email = NULL;
$temporary_password = NULL;
$temporary_confirm_password= NULL;
    
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Controller/Registration/account_checking.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_pictures.php");
require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_likes.php");
?>

<div id="home-disconnected">
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


	<div id="my-photos-container-2">
		<div class="pagination top-pag">
			<?php
			echo '<a href="http://localhost:8080/Camagru/index.php?page=1">&laquo;</a>'; 
			for ($i = 1; $i <= $totalPages; $i++)
			{
				if ($i == $currentPage)
				{
					echo '<a href="http://localhost:8080/Camagru/index.php?page='.$i.'" class="a-active">'.$i.'</a>';
				}
				else
				{
					echo '<a href="http://localhost:8080/Camagru/index.php?page='.$i.'">'.$i.'</a>';
				}
			}
			echo '<a href="http://localhost:8080/Camagru/index.php?page='.$totalPages.'">&raquo;</a>';
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
					<img src=<?= $picture[1] ?> class="img-home-page"><hr/>
					<?php
						foreach ($result_likes as $like)
						{
							if ($like[2] == $picture[0])
							{
								$likes_number++;
							}
						}
					?>
					<div id="like-comment">
						<img src='/Camagru/Public/Image/love_black.png' onmouseout="this.src='/Camagru/Public/Image/love_black.png';" onmouseover="this.src='/Camagru/Public/Image/love.png';" id="like" class="form-like-comment like" onclick="alertLike()">

						<p class="like-phrase"><?= $likes_number ?><span class="like-word">j'aime</span></p>

						<img src='/Camagru/Public/Image/comment-white-oval-bubble.png' onmouseover="this.src='/Camagru/Public/Image/comment-black-oval-bubble-shape.png';" onmouseout="this.src='/Camagru/Public/Image/comment-white-oval-bubble.png';" id="comment" class="like comment-word" onclick="alertComment()">
					</div>
				</div>
		<?php	$start++; 
				}
			?>
		</div>
		<div class="pagination bottom-pag">
			<?php
				echo '<a href="http://localhost:8080/Camagru/index.php?page=1">&laquo;</a>';
				for ($i = 1; $i <= $totalPages; $i++)
				{
					if ($i == $currentPage)
					{
						echo '<a href="http://localhost:8080/Camagru/index.php?page='.$i.'" class="a-active">'.$i.'</a>';
					}
					else
					{
						echo '<a href="http://localhost:8080/Camagru/index.php?page='.$i.'">'.$i.'</a>';
					}
				}
				echo '<a href="http://localhost:8080/Camagru/index.php?page='.$totalPages.'">&raquo;</a>';
			?>
		</div>
    </div>
    <section id="form">
        <!-- connexion -->
        <form class="formsignup" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
        <a href="/Camagru/index.php"><img src="/Camagru/Public/Image/camagru_logo.png"></a>
            <input type="text" name="pseudo_mail" id="pseudo_mail" placeholder="Adresse e-mail ou Pseudonyme" <?php if (isset($temporary_connector)) {?> value="<?= $temporary_connector ?>" <?php  }?>/>
            <?php if (isset($connector_message_alert)){?> <p class="alert_message"><?=$connector_message_alert;?></p><?php }?>
            <input class="last_input" type="password" name="password_user" id="password_user" placeholder="Mot de passe" <?php if (isset($temporary_password_connector)) {?> value="<?= $temporary_password_connector ?>" <?php  }?>/>
            <?php if (isset($password_message_alert_connect)){?> <p class="alert_message"><?=$password_message_alert_connect;?></p><?php }?>
            <?php if (isset($empty_message_alert_connect)){?><p class="alert_message"><?=$empty_message_alert_connect;?></p><?php }?>
            <button class="button fbutton" type="submit" name="connexion_butt">Se Connecter</button>
        <p class="mdpf"><a href="/Camagru/View/User/Forgotten_Password/forgpass_get_email.php">Mot de passe oublié ?</a></p>
        </form>

        <!-- inscription -->
        <form class="formsignup formmarg" method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
            <p>Pas encore de compte ? Inscrivez-vous pour voir les photos montages de vos amis.</p>
            <input type="text" name="lastname" id="lastname" placeholder="Nom" <?php if (isset($temporary_lastname)) {?> value="<?= $temporary_lastname ?>" <?php  }?>/>
            <?php if (isset($lastname_message_alert)){?> <p class="alert_message"><?=$lastname_message_alert;?></p><?php }?>
            <input type="text" name="firstname" id="firstname" placeholder="Prénom" <?php if (isset($temporary_firstname)) {?> value="<?= $temporary_firstname ?>" <?php  }?>/>
            <?php if (isset($firstname_message_alert)){?> <p class="alert_message"><?=$firstname_message_alert;?></p><?php }?>
            <input type="text" name="pseudonym" id="pseudonym" placeholder="Pseudonyme" <?php if (isset($temporary_pseudonym)) {?> value="<?= $temporary_pseudonym ?>" <?php  }?>>
            <?php if (isset($pseudo_message_alert)){?> <p class="alert_message"><?=$pseudo_message_alert;?></p><?php }?>
            <?php if (isset($pseudo_exist_message_alert)){?> <p class="alert_message"><?=$pseudo_exist_message_alert;?></p><?php }?>
            <input type="email" name="email" id="email" placeholder="E-mail" <?php if (isset($temporary_email)) {?> value="<?= $temporary_email ?>" <?php  }?>>
            <?php if (isset($email_message_alert)){?> <p class="alert_message"><?=$email_message_alert;?></p><?php }?>
            <?php if (isset($email_exist_message_alert)){?> <p class="alert_message"><?=$email_exist_message_alert;?></p><?php }?>
            <input type="password" name="password" id="password" placeholder="Mot de passe" <?php if (isset($temporary_password)) {?> value="<?= $temporary_password ?>" <?php  }?>>
            <?php if (isset($password_message_alert)){?> <p class="alert_message"><?=$password_message_alert;?></p><?php }?>
            <input class="last_input" type="password" name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe" <?php if (isset($temporary_confirm_password)) {?> value="<?= $temporary_confirm_password ?>" <?php  }?>>
            <?php if (isset($password_confirm_message_alert)){?> <p class="alert_message"><?=$password_confirm_message_alert;?></p><?php }?>
            <?php if (isset($empty_message_alert)){?> <p class="alert_message"><?=$empty_message_alert;?></p><?php }?>
            <?php if (isset($failure_message)){?> <p class="alert_message"><?=$failure_message;?></p><?php }?>
            <button class="button" type="submit" name="inscription_butt" value='inscription_btn'>S'inscrire</button>
        </form>
    </section> 
</div>

<script src="/Camagru/Public/JavaScript/home.js"></script>

<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require($_SERVER['DOCUMENT_ROOT']."/Camagru/View/template.php");
?>