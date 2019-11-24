<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/Model/DB_connect.php");

class comment
{
    static function add_comment($id_user, $id_picture, $comment)
    {
        $db = connexion();

        $statement = $db->prepare("INSERT INTO comments (id_user, id_picture, comment) VALUES (:id_user, :id_picture, :comment)");

        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);
        $statement->bindValue(':comment', $comment, PDO::PARAM_STR);

        $statement->execute();

        $count = $statement->rowCount();

        return $count;
    }

    static function get_comments($id_picture)
    {
        $db = connexion();

        $statement = $db->prepare("SELECT id_comment, id_user, id_picture, comment, DATE_FORMAT(datecomment, 'le %d/%m/%Y à %Hh%i') AS datecomment FROM comments WHERE id_picture=:id_picture ORDER BY id_comment DESC");

        $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);

        $statement->execute();

        $count = $statement->rowCount();
        $id_comments = $statement->fetchAll();

        $result = array($count, $id_comments);

        return $result;
    }

    static function get_user($id_user)
    {
        $db = connexion();

        $statement = $db->prepare("SELECT * FROM users WHERE id_user=:id_user");

        $statement->bindValue(':id_user', $id_user, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->fetch();

        return $result;
    }

    static function get_idUser_byIdpicture($id_picture)
    {
        $db = connexion();

        $statement = $db->prepare("SELECT id_user FROM pictures WHERE id_picture=:id_picture");

        $statement->bindValue(':id_picture', $id_picture, PDO::PARAM_INT);

        $statement->execute();

        $result = $statement->fetch();

        return $result[0];
    }
    static function send_email_notif($email, $pseudonym, $pseudonym_user, $date)
    {
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=utf8';
        $mail_subject = "Un commentaire a été ajouté a votre photo !";
        $mail_confirm_message = '
            <html>
                <body>
                    <p>
                    Bonjour ' . $pseudonym . ' !<br/>'
                    .$pseudonym_user.' a commenté votre photo le '.$date.'.<br/>
                    Cet e-mail est généré automatiquement. Merci de ne pas y répondre.<br/><br/>
                    L\'équipe Camagru ©.
                    </p>
                </body>
            </html>';
        $result = mail($email, $mail_subject, $mail_confirm_message, implode("\r\n", $headers));
    }
}

?>