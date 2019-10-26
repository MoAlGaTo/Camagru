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
echo '<br/>';
echo "Selem Aleykoum ".$_SESSION['pseudonym']." !";
echo '<br/>';
echo $_SESSION['id_user'];
echo '<br/>';
echo $_SESSION['lastname'];
echo '<br/>';
echo $_SESSION['firstname'];
echo '<br/>';
echo $_SESSION['pseudonym'];
echo '<br/>';
echo $_SESSION['email'];
echo '<br/>';
//session_destroy();
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