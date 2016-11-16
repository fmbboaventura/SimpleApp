<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Simple App</title>
    </head>
    <body>
        <?php
            require 'classes/DB.class.php';
            require 'classes/User.class.php';
            require 'classes/UserTools.class.php';
            $db = new DB();
            try {
                $db->connect();
                $user = new User(array(
                    "username" => "br", "password" =>
                    "br123", "email" => "br@mail.com",
                    "join_date" => date("Y-m-d H:i:s")));
                //$user->save(true);
                $tools = new UserTools();
                $tools->login("br", "br123");
                //$db->update(array("email" => "hu3@mail.com.br"), "users", "`username` = 'hu3'");
                //$db->delete("users", "`username` = 'br'");
                $array = $db->select("users");
                foreach ($array as $row) {
                    print_r($row);
                }
                $db->closeConnection();
                print_r($_SESSION);
            } catch(PDOException $e)
            {
                echo "Caiu na exception: " . $e->getMessage();
            }
        ?>
    </body>
</html>
