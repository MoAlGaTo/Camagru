<?php 
session_start();
if (session_status() === PHP_SESSION_NONE)
{
    echo 'NONE';
}
else if (session_status() === PHP_SESSION_ACTIVE)
{
    echo 'ACTIVE';
}
else if ( session_status() === PHP_SESSION_DISABLED)
{
    echo 'DISABLED';
}
echo "Selem Aleykoum ".$_SESSION['pseudonym']." !";
session_destroy();
if (session_status() === PHP_SESSION_NONE)
{
    echo 'NONE';
}
else if (session_status() === PHP_SESSION_ACTIVE)
{
    echo 'ACTIVE';
}
else if ( session_status() === PHP_SESSION_DISABLED)
{
    echo 'DISABLED';
}

?>