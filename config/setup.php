<?php

require_once($_SERVER['DOCUMENT_ROOT']."/Camagru/config/database.php");


$bdd = $db = connexion();

$database_drop = "DROP DATABASE IF EXISTS camagru_db";
$database = "CREATE DATABASE IF NOT EXISTS camagru_db CHARACTER SET 'utf8' COLLATE = utf8_general_ci";

try 
{
    $bdd->prepare($database_drop)->execute();
    $bdd->prepare($database)->execute();
}
catch (PDOException $ex)
{
    echo "erreur de la creation de la base de donnée ".$ex->getMessage()."<br/>";
}

try {
    
    $bdd->prepare("USE camagru_db;")->execute();

}
catch(PDOException $ex)
{
    echo "erreur de la creation de la base de donnée ".$ex->getMessage()."<br/>";
}


/* creation de la tables users */

$table_drop = "DROP TABLE IF EXISTS users";
$table = "CREATE TABLE IF NOT EXISTS users(
    id_user INT PRIMARY KEY  NOT NULL AUTO_INCREMENT,
    lastname VARCHAR(50) NOT NULL,
    firstname VARCHAR(50) NOT NULL,
    pseudonym VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    passworduser VARCHAR(100) NOT NULL,
    confirm_key VARCHAR(100) NOT NULL,
    confirm_account_key INT NOT NULL,
    confirm_key_password VARCHAR(100) NOT NULL,
    confirm_account_key_password INT NOT NULL,
    key_infup INT NOT NULL,
    receive_notif INT NOT NULL
)";

try 
{
    $bdd->prepare($table_drop)->execute();
    $bdd->prepare($table)->execute();
}
catch (PDOException $ex)
{
    echo "erreur de la requête sql ".$ex->getMessage()."<br/>";
}




/* creation de la table pictures */

$table_drop = "DROP TABLE IF EXISTS pictures";
$table = "CREATE TABLE IF NOT EXISTS pictures(
    id_picture INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    picture LONGBLOB NOT NULL,
    datepicture TIMESTAMP NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE
)";
try 
{
    $bdd->prepare($table_drop)->execute();
    $bdd->prepare($table)->execute();
}
catch (PDOException $ex)
{
    echo "erreur de la requête sql ".$ex->getMessage()."<br/>";
}




/* creation de la table comments */

$table_drop = "DROP TABLE IF EXISTS likes";
$table = "CREATE TABLE IF NOT EXISTS likes(  
    id_like INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user INT,
    id_picture INT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_picture) REFERENCES pictures (id_picture) ON DELETE CASCADE ON UPDATE CASCADE
)";
try 
{
    $bdd->prepare($table_drop)->execute();
    $bdd->prepare($table)->execute();
}
catch (PDOException $ex)
{
    echo "erreur de la requête sql ".$ex->getMessage()."<br/>";
}



/* creation de la table comments */

$table_drop = "DROP TABLE IF EXISTS comments";
$table = "CREATE TABLE IF NOT EXISTS comments(
    id_comment INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_user INT NOT NULL,
    id_picture INT NOT NULL,
    comment VARCHAR(200),
    datecomment TIMESTAMP NOT NULL,
    FOREIGN KEY (id_user) REFERENCES users (id_user) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_picture) REFERENCES pictures (id_picture) ON DELETE CASCADE ON UPDATE CASCADE
)";
try 
{
    $bdd->prepare($table_drop)->execute();
    $bdd->prepare($table)->execute();
}
catch (PDOException $ex)
{
    echo "erreur de la requête sql ".$ex->getMessage()."<br/>";
}


$bdd = NULL;

?>
