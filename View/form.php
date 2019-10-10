<?php ob_start();
require("../Controller/form_verif.php") ?>


<section id="form">
    <form class="formsignup" method="POST" action="">
    <img src="../public/camagru_logo.png">
        <input type="text" name="pseudo_mail" id="pseudo_mail" placeholder="Adresse e-mail ou Pseudonyme" size="35"
            maxlength="15" />
        <input class="last_input" type="text" name="password_user" id="password_user" placeholder="Mot de passe" size="35"
            maxlength="15" />
        <button class="button fbutton">Se Connecter</button>
       <p class="mdpf"><a href="">Mot de passe oublié ?</a></p>
    </form>
    <form class="formsignup formmarg" method="POST" action="">
        <p>Pas encore de compte ? Inscrivez-vous pour voir les photos montages de vos amis.</p>
        <input type="text" name="lastname" id="lastname" placeholder="Nom" size="35" maxlength="35"/>
        <input type="text" name="firstname" id="firstname"
            placeholder="Prénom" size="35" maxlength="35"/>
        <input type="text" name="pseudonym" id="pseudonym"
            placeholder="Pseudonyme" size="35" maxlength="15">
        <input type="text" name="email" id="email" placeholder="E-mail" size="35"
            maxlength="50">
        <input type="text" name="password" id="password"
            placeholder="Mot de passe" size="35" maxlength="15">
        <input class="last_input" type="text"
            name="password_confirm" id="password_confirm" placeholder="Confirmation mot de passe" size="35"
            maxlength="15">
        <button class="button">S'inscrire</button>
    </form>
</section>
<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require("template.php");
?>