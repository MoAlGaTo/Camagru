<?php

// class DataBase extends PDO
// {
//     function __construct()
//     {
//         $dsn = 'mysql:host=localhost:3306;dbname=camagru_db;charset=utf8';
//         // $dsn = 'mysql:dbname=camagru_db;host=127.0.0.1';
//         $user = 'root';
//         $password = 'mohamedali';
//         $db = null;
//         try {
//             // $db = new PDO($dsn, $user, $password);
//         $db = new PDO($dsn, $user, $password);

//         } catch (PDOException $error) {
//             echo ('Erreur de connexion à la base de données (Database Connection Error)...' . $error->getMessage());
//         }
//         return $db;
//     }
// }


// fonction qui 
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


// class de base qui ne fonctionne pas...a revoir
// class DataBase
// {
//     public function __construct()
//     {
//         try
//         {
//             $db = new PDO('mysql:host=localhost:3306;dbname:camagru_db;charset=utf8', 'root', 'mohamedali');
//             return $db;
//         }
//         catch (Exception $error)
//         {
//             die('Erreur de connexion à la base de données (Database Connection Error)...');
//         }
//     }