<?php

use controller\IndexController;
use controller\LoginController;
use model\Login;
use model\ShopRenterData;
use controller\Controller;
use view\ShopRenterDataView;
use view\LoginView;
use lib\database\Database;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php
        $loginModel = new Login();
        $loginController = new LoginController($loginModel);

        $userModel = new model\User();
        $indexController = new IndexController($userModel);
        $action = filter_input(INPUT_GET, "action");

        if (isset($action)) {
            switch ($action) {
                case "login":
                    $userId = $loginController->getLogin();
                    if ($userId > 0) {
                        $_SESSION["userId"] = $userId;
                        $indexController->settings();
                    } else {
                        $loginController->login();
                    }

                    break;
                case "settings":
                    if (isset($_SESSION["userId"])) {
                        $indexController->settings();
                    } else {
                        $loginController->login();
                    }
                    break;
                case "logout":
//                    var_dump("log_out");
                    $loginController->logout();
                    break;
                default :
                    if (isset($_SESSION["userId"])) {
                        $indexController->settings();
                    } else {
                        $loginController->login();
                    }
                    break;
            }
        } else {
            if (isset($_SESSION["userId"])) {
                $indexController->settings();
            } else {
                $loginController->login();
            }
        }
        ?>
















    </body>
</html>