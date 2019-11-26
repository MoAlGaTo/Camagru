<?php
session_start();
$_SESSION = array();
session_destroy();

if (session_status() === PHP_SESSION_NONE)
{
    header("location: /Camagru/index.php");
    exit;
}
else
{
    header("location: /Camagru/View/404_error.html");
    die();
}
?>