<?php
function connexion()
{
    $dsn = 'mysql:dbname=camagru_db;host=127.0.0.1';
    $user = 'root';
    $password = 'mohamedali';
    try {
        $db = new PDO($dsn, $user, $password);
    } catch (PDOException $error) {
        echo ('Erreur de connexion à la base de données (Database Connection Error)...' . $error->getMessage());
    }
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}
?>