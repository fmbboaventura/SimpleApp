<?php require_once 'includes/global.inc.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Pagina Inicial</title>
    </head>
    <body>
        <?php if(isset($_SESSION['logged_in'])) : ?>
        <?php $user = unserialize($_SESSION['user']); ?>
            Olá, <?php echo $user->username; ?>. Você fez login.
            <!-- <a href="logout.php">Logout</a> | <a href="settings.php">Change Email</a> -->
        <?php else : ?>
            Você não fez login.
            <a href="login.php">Log In</a> | <a href="register.php">Cadastro</a>
        <?php endif; ?>
    </body>
</html>
