<?php
require_once 'includes/global.inc.php';

$error = "";
$username = "";
$password = "";

if (isset($_POST['submit-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($userTools->login($username, $password)) {
        header("Location: index.php");
   }else{
       $error = "Nome de usuário ou senha incorretos. Por favor, tente outra vez.";
   }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
    </head>
    <body>
        <?php
        if($error != "")
        {
            echo $error."<br/>";
        }
        ?>
        <form action="login.php" method="post">
            Usuário: <input type="text" name="username" value="<?php echo $username; ?>" /><br/>
            Senha: <input type="password" name="password" value="<?php echo $password; ?>" /><br/>
            <input type="submit" value="Login" name="submit-login" />
        </form>
    </body>
</html>
