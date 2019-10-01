<?php ob_start(); ?>

<section id="form">
    <meta charset="UTF-8">
    <form method="POST" action="">
        <p class="field">
            <label for="Pseudo">Pseudonyme</label><br /><input type="text" name="Pseudo" id="Pseudo" placeholder="Adresse e-mail ou Pseudonyme" size="35" maxlength="15">
        </p>
        <p class="field">
            <label for="Mot de Passe">Mot de Passe</label><br /><input type="text" name="Pseudo" id="Pseudo" placeholder="Votre Mot De Passe" size="35" maxlength="15">
        </p>

    </form>

    <p class="ou">OÙ</p>

    <form method="POST" action="">
        <p class="field">
            <label for="Nom">Nom</label><br /><input type="text" name="Nom" id="Nom" placeholder="Nom De Famille" size="35" maxlength="35">
        </p>
        <p class="field">
            <label for="prenom">Prénom</label><br /><input type="text" name="prenom" id="prenom" placeholder="Prénom" size="35" maxlength="35">
        </p>
        <p>
            <label for="Pseudo">Pseudonyme</label><br /><input type="text" name="Pseudo" id="Pseudo" placeholder="Pseudonyme" size="35" maxlength="15">
        </p>
        <p class="field">
            <label for="mail">E-mail</label><br /><input type="text" name="mail" id="mail" placeholder="E-mail" size="35" maxlength="15">
        </p>
        <p class="field">
            <label for="mdp">Mot de Passe</label><br /><input type="text" name="mdp" id="mdp" placeholder="Mot De Passe" size="35" maxlength="15">
        </p>
        <p class="field">
            <label for="mdpc">Confirmez Votre Mot De Passe</label><br /><input type="text" name="mdpc" id="mdpc" placeholder="Confirmation Mot De Passe" size="35" maxlength="15">
        </p>
    </form>
</section>
<?php
$content = ob_get_clean();
$css_link = "style_form.css";
require("template.php");
?>