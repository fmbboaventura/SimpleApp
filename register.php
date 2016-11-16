<?php
require_once 'includes/global.inc.php';

//Inicializando variaveis do formulário
$username = "";
$password = "";
$password_confirm = "";
$email = "";
$error = "";

// checa se o form foi submetido
if(isset($_POST['submit-form']))
{
    //recupera as variaveis $_POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];
    $email = $_POST['email'];

    //inicializa as variáveis para validação do form
    $success = true;

    if ($userTools->checkUsernameExists($username)) {
        $error .= "Esse usuário já existe.<br/> \n\r";
        $success = false;
    }

    if ($password != $password_confirm) {
        $error .= "As senhas não são iguais.<br/> \n\r";
        $success = false;
    }

    if ($success)
    {
        $data['username'] = $username;
        $data['password'] = $password;
        $data['email'] = $email;

        //create the new user object
        $newUser = new User($data);

        //save the new user to the database
        $newUser->save(true);

        //log them in
        $userTools->login($username, $password);
        //redirect them to a welcome page
        header("Location: welcome.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <head>
            <title>Cadastro</title>
        </head>
        <body>
            <?php echo ($error != "") ? $error : ""; ?>
            <form action="register.php" method="post">

            Nome do Usuário: <input type="text" value="<?php echo $username; ?>" name="username" /><br/>
            Senha: <input type="password" value="<?php echo $password; ?>" name="password" /><br/>
            Confirmar Senha: <input type="password" value="<?php echo $password_confirm; ?>" name="password-confirm" /><br/>
            E-Mail: <input type="text" value="<?php echo $email; ?>" name="email" /><br/>
            <input type="submit" value="Cadastrar" name="submit-form" />

            </form>
        </body>
</html>
