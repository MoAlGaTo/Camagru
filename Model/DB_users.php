<?php

require_once("DB_connect.php");

class user
{
    // Verifie si le pseudonym est existant
    public function check_pseudo($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare("SELECT * FROM users WHERE pseudonym=:pseudonym");

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }
    // Verifie si le mail est existant
    public function check_email($email)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE email=:email');

        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }
    // Verifie si le mot de passe est existant
    static function check_password($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:pseudonym');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

		$result = $statement->fetch();
		
		return $result['passworduser'];
    }
    // Ajoute un nouveau user
    public function add_user($lastname, $firstname, $pseudonym, $email, $password_user, $confirm_key)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('INSERT INTO users (lastname, firstname, pseudonym, email, passworduser, confirm_key)
        VALUES (:lastname, :firstname, :pseudonym, :email, :password_user, :confirm_key)');

        $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':password_user', $password_user, PDO::PARAM_STR);
        $statement->bindValue(':confirm_key', $confirm_key, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }
    // Verifie la correspondance du pseudo et de la clé generee pour le mail de confirmation
    static function check_confirm_key($pseudonym, $confirm_key)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:pseudonym AND confirm_key=:confirm_key');

        $statement->bindValue(':confirm_key', $confirm_key, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }
    // Verifie si la clé d'activation est a 0
    static function check_confirm_account_key($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:pseudonym AND confirm_account_key=0');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }
    // Active la clé du compte en la mettant a 1
    static function set_confirm_account_key($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('UPDATE users SET confirm_account_key=1 WHERE pseudonym=:pseudonym');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }
    // Verifie la correspondance du pseudo et la cle de du mail du mot de passe oublie
    static function check_confirm_key_password($pseudonym, $confirm_key)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:pseudonym AND confirm_key_password=:confirm_key');

        $statement->bindValue(':confirm_key', $confirm_key, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }
    // Verifie si la cle du mot de passe oublie est a 1 ou 0
    static function check_confirm_account_key_password($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:pseudonym');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_INT);

        $statement->execute();

		$result = $statement->fetch();
		
		return $result['confirm_account_key_password'];
    }
     // Active ou desactive la cle du mot de passe
     static function set_confirm_password_key($numberSet, $pseudonym)
     {
         // $db = new DataBase;
         $db = connexion();
 
         $statement = $db->prepare('UPDATE users SET confirm_account_key_password=:numberSet WHERE pseudonym=:pseudonym');
 
         $statement->bindValue(':numberSet', $numberSet, PDO::PARAM_INT);
         $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);
 
         $statement->execute();
 
         $result = $statement->rowCount();
 
         return $result;
     }
    // Modifie les infos d'un user connecte
    public function edit_information($lastname, $firstname, $pseudonym, $email, $id)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('UPDATE users 
        SET lastname=:lastname, firstname=:firstname, pseudonym=:pseudonym, email=:email  WHERE id_user=:id');

        $statement->bindValue(':lastname', $lastname, PDO::PARAM_STR);
        $statement->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }
    // Modifie le mot de passe d'un user connecte ou ayant oublie sont mot de passe
    static function edit_password($password_user, $pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('UPDATE users SET passworduser=:password_user WHERE pseudonym=:pseudonym');

        $statement->bindValue(':password_user', $password_user, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }
    // Verifie le user en verifiant son identifiant et retourne la ligne pour verifier ensuite le mot de passe 
    static function account_connect($connector)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:connector OR email=:connector');

        $statement->bindValue(':connector', $connector, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }
    // Genre une cle de confirmation pour le mail de confirmation ou le mot de passe oublié
    public function make_confirm_key()
    {
        $key_length = 15;
        $confirm_key = "";

        for ($i = 1; $i < $key_length; $i++)
        {
            $confirm_key .= mt_rand(0, 9);
        }
        return $confirm_key;
    }
    // Envoi le mail de confirmation avec le pseudo et la cle generee
    public function send_email($email, $pseudonym, $confirm_key)
    {
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf8';
        $mail_subject = "Confirmation de votre compte Camagru";
        $mail_confirm_message = '
            <html>
                <body>
                    <p>
                    Bienvenue ' . $pseudonym . ' ! Vous venez de vous inscrire sur Camagru, et nous vous en remercions. Pour confirmer votre compte, et pouvoir ainsi accéder à votre espace personnel, veuillez cliquer sur lien ci-dessous:<br/><br/><a href="http://localhost:8080/Camagru/Controller/email_verif.php?pseudo=' . urlencode($pseudonym) . '&amp;key=' . urlencode($confirm_key) . '">Cliquez sur ce lien pour confirmer votre compte.</a><br/><br/>
                    Cet e-mail est généré automatiquement. Merci de ne pas y répondre.<br/><br/>
                    L\'équipe Camagru ©.
                    </p>
                </body>
            </html>';
        $result = mail($email, $mail_subject, $mail_confirm_message, implode("\r\n", $headers));

        return $result;
    }
    // Envoi un mail pour reinitialiser son mot de passe oublie
    public function send_mail_forgotten_password($pseudonym, $email, $confirm_key)
    {
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf8';
        $mail_subject = "Réinitialisation de votre mot de passe Camagru";
        $mail_confirm_message = '
            <html>
                <body>
                    <p>
                    Bonjour ' . $pseudonym . ' ! Voici le lien pour réinitialiser le mot de passe de votre compte Camagru:<br/><br/><a href="http://localhost:8080/Camagru/View/update_forgotten_password.php?pseudo=' . urlencode($pseudonym) . '&amp;key=' . urlencode($confirm_key) . '">Cliquez sur ce lien pour réinitialiser votre mot de passe.</a><br/><br/>
                    Cet e-mail est généré automatiquement. Merci de ne pas y répondre.<br/><br/>
                    L\'équipe Camagru ©.
                    </p>
                </body>
            </html>';

        $result = mail($email, $mail_subject, $mail_confirm_message, implode("\r\n", $headers));

        return $result;
    }
    // Met la cle de confirmation genere du mot de passe oublie
    public function update_confirm_key_password($confirm_key, $pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('UPDATE users SET confirm_key_password=:confirm_key WHERE pseudonym=:pseudonym');

        $statement->bindValue(':confirm_key', $confirm_key, PDO::PARAM_STR);
        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }
    //  Supprime le compte si le mail n'a pas pu etre envoye
    public function delete_account($pseudonym)
    {
        // $db = new DataBase;
        $db = connexion();
        
        $statement = $db->prepare('DELETE FROM users WHERE pseudonym=:pseudonym');

        $statement->bindValue(':pseudonym', $pseudonym, PDO::PARAM_STR);

        $statement->execute();

        $result = $statement->rowCount();

        return ($result);
    }
}
