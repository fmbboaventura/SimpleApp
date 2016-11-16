<?php
require_once 'User.class.php';
require_once 'DB.class.php';

/**
 *
 */
class UserTools
{

    public function login($username, $password)
    {
        $db = new DB();
        $db->connect();
        $result = $db->select('users', "`username` = '$username' AND `password` = '$password'");

        if (count($result) == 1)
        {
            $_SESSION["user"] = serialize(new User($result));
            $_SESSION["login_time"] = time();
            $_SESSION["logged_in"] = 1;
            return true;
        }else{
            return false;
        }
    }

    //Log the user out. Destroy the session variables.
    public function logout() {
        unset($_SESSION['user']);
        unset($_SESSION['login_time']);
        unset($_SESSION['logged_in']);
        session_destroy();
    }
}

?>