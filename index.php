<?php
session_start();
require "Authenticator.php";

$Authenticator = new Authenticator();
if (!isset($_SESSION['auth_secret'])) {
    $secret = $Authenticator->generateRandomSecret();
    $_SESSION['auth_secret'] = $secret;
}

$qrCodeUrl = $Authenticator->getQR('banking_demo_local', $_SESSION['auth_secret']);

if (!isset($_SESSION['failed'])) {
    $_SESSION['failed'] = false;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Time-Based Authentication like Google Authenticator</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <meta name="description" content="Implement Google like Time-Based Authentication into your existing PHP application. And learn How to Build it? How it Works? and Why is it Necessary these days."/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <link rel='shortcut icon' href='/favicon.ico'  />
    </head>
    <body>
        <?php 
            if (!isset($_GET["page"]) || isset($_GET["page"]) && $_GET["page"] == "login") {
                include "login.php";
            } else if (isset($_GET["page"]) && $_GET["page"] == "register") {
                include "register.php";
            }
        ?>
    </body>
</html>