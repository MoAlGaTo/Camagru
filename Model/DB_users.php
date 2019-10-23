<?php

require_once("DB_connect.php");

class user
{
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

    public function check_email($email)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE email=:email');

        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }

    public function check_password($id)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE id_user=:id');

        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

		$result = $statement->fetch();
		
		return $result['passworduser'];
    }

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

    public function edit_password($password_user, $id)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('UPDATE users SET passworduser=:password_user WHERE id_user=:id');

        $statement->bindValue(':password_user', $password_user, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->rowCount();

        return $result;
    }

    static function account_connect($connector)
    {
        // $db = new DataBase;
        $db = connexion();

        $statement = $db->prepare('SELECT * FROM users WHERE pseudonym=:connector OR email=:connector');

        $statement->bindValue(':connector', $connector, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        if ($count)
        {
            $result = $statement->fetch();
            return $result;
        }
        else
        {
            return $count;
        }
    }

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
