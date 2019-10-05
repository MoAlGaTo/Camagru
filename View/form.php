<?php ob_start();
require("../Controller/form_verif.php") ?>


<section id="form">
    <form method="POST" action="">
        <label for="pseudo_mail">Pseudonyme</label><br />
        <input type="text" name="pseudo_mail" id="pseudo_mail" placeholder="Adresse e-mail ou Pseudonyme" size="35"
            maxlength="15" />
        <br />
        <label for="password_user">Mot de Passe</label><br />
        <input type="text" name="password_user" id="password_user" placeholder="Votre Mot De Passe" size="35"
            maxlength="15" />
        <br />
        <button class="button">Se Connecter</button>
    </form>
    <br />
    <p class="ou">OU</p>
    <form method="POST" action="">
        <label for="lastname">Nom</label><br />
        <input type="text" name="lastname" id="lastname" placeholder="Nom De Famille" size="35" maxlength="35"/>
        <br />
        <label for="firstname">Prénom</label><br />
        <input type="text" name="firstname" id="firstname"
            placeholder="Prénom" size="35" maxlength="35"/>
        <br />
        <label for="pseudonym">Pseudonyme</label><br />
        <input type="text" name="pseudonym" id="pseudonym"
            placeholder="Pseudonyme" size="35" maxlength="15">
        <br />
        <label for="email">E-mail</label><br />
        <input type="text" name="email" id="email" placeholder="E-mail" size="35"
            maxlength="50">
        <br />
        <label for="password">Mot de Passe</label><br />
        <input type="text" name="password" id="password"
            placeholder="Mot De Passe" size="35" maxlength="15">
        <br />
        <label for="password_confirm">Confirmez Votre Mot De Passe</label><br />
        <input type="text"
            name="password_confirm" id="password_confirm" placeholder="Confirmation Mot De Passe" size="35"
            maxlength="15">
        <br />
        <button class="button">S'inscrire</button>
    </form>
</section>
<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require("template.php");
?>