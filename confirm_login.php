<?php
    require "Authenticator.php";
    include 'connect_DB.php';
    session_start();
    $connect = OpenCon();
    mysqli_set_charset($connect,"utf8");

    if (isset($_POST["login"])) {
        header('Content-Type: text/html; charset=UTF-8');

        $user_name = addslashes($_POST['username']);
        $password = md5(addslashes($_POST['password']));

        if (!$user_name || !$password) {
            header("location:index.php?page=login");
            setcookie("error", "please enter all fields", time()+1, "/","", 0);
            exit;
        }

        $rows = mysqli_query($connect, "select * from users where user_name = '$user_name' and password = '$password'");
        $count = mysqli_num_rows($rows);

        if ($count == 1) {
            $row = $rows->fetch_assoc();
            $_SESSION['role'] = $row['role'];
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $user_name;
            $_SESSION['login'] = true;
            $_SESSION['user_secret'] = $row['google_code'];
        } else {
            header("location:index.php?page=login");
            setcookie("error", "login information is not correct", time()+1, "/","", 0);
            exit;
        }
    } else {
        header("location:index.php?page=login");
        exit;
    }
    
    if (!isset($_SESSION['failed'])) {
        $_SESSION['failed'] = false;
    }

    CloseCon($connect);
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
    <style>
        body,html {
            height: 100%;
        }       


        .bg { 
            /* The image used */
            background-image: url("images/bg.jpg");
            /* Full height */
            height: 100%; 
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
           
            background-size: cover;
        }
    </style>
</head>
<body  class="bg">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3"  style="background: white; padding: 20px; box-shadow: 10px 10px 5px #888888; margin-top: 100px;">
                <h1>Time-Based Authentication</h1>
                <p style="font-style: italic;">A Google Authenticator kinda Authentication</p>
                <hr>
                <form action="check.php" method="post">
                    <div style="text-align: center;">        
                        <input type="text" class="form-control" name="code" placeholder="******" style="font-size: xx-large;width: 200px;border-radius: 0px;text-align: center;display: inline;color: #0275d8;"><br> <br>    
                        <button type="submit" name='confirm_login' class="btn btn-md btn-primary" style="width: 200px;border-radius: 0px;">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>