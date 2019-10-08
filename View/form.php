<?php ob_start();
require("../Controller/form_verif.php") ?>


<section id="form">
    <img src="../public/camagru_logo.png">
    <form class="formsignup" method="POST" action="">
        <label for="pseudo_mail">Pseudonyme</label>
        <input type="text" name="pseudo_mail" id="pseudo_mail" placeholder="Adresse e-mail ou Pseudonyme" size="35"
            maxlength="15" />
        <label for="password_user">Mot de Passe</label>
        <input type="text" name="password_user" id="password_user" placeholder="Votre Mot De Passe" size="35"
            maxlength="15" />
        <button class="button">Se Connecter</button>
    </form>
    <div class="ou">
    <h1 class="hr">OU</h1>
</div>
    <form class="formsignup" method="POST" action="">
        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" placeholder="Nom De Famille" size="35" maxlength="35"/>
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname"
            placeholder="Prénom" size="35" maxlength="35"/>
        <label for="pseudonym">Pseudonyme</label>
        <input type="text" name="pseudonym" id="pseudonym"
            placeholder="Pseudonyme" size="35" maxlength="15">
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" placeholder="E-mail" size="35"
            maxlength="50">
        <label for="password">Mot de Passe</label>
        <input type="text" name="password" id="password"
            placeholder="Mot De Passe" size="35" maxlength="15">
        <label for="password_confirm">Confirmez Votre Mot De Passe</label>
        <input type="text"
            name="password_confirm" id="password_confirm" placeholder="Confirmation Mot De Passe" size="35"
            maxlength="15">
        <button class="button">S'inscrire</button>
    </form>
</section>
<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require("template.php");
?>