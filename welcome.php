<?php
//welcome.php

require_once 'includes/global.inc.php';

//check to see if they're logged in
if(!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
}

//get the user object from the session
$user = unserialize($_SESSION['user']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bem vindo, <?php echo $user->username; ?>!</title>
    </head>
    <body>
        Olá, <?php echo $user->username; ?>.
        Você foi cadastrado e sua sessão foi iniciada. Bem vindo!
        <a href="logout.php">Log Out</a> |
        <a href="index.php">Voltar a Homepage</a>

    </body>
</html>
