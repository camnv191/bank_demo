<?php
    require "Authenticator.php";
    include 'connect_DB.php';
    session_start();
    $connect = OpenCon();
    mysqli_set_charset($connect,"utf8");

    if (isset($_POST["register"])) {
        header('Content-Type: text/html; charset=UTF-8');

        $name = addslashes($_POST['name']);
        $user_name = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);
        $password_confirm = addslashes($_POST['password_confirm']);

        if (!$user_name || !$name || !$password || !$password_confirm) {
            header("location:index.php?page=register");
            setcookie("error", "vui long nhap du truong", time()+1, "/","", 0);
            exit;
        }

        if ($password != $password_confirm) {
            header("location:index.php?page=register");
            setcookie("error", "Password and confirm password does not match", time()+1, "/","", 0);
            exit;
        }

        if (mysqli_num_rows(mysqli_query($connect," select user_name from users where user_name = '$user_name'")) > 0) {
          header("location:index.php?page=register");
          setcookie("error", "username is exists", time()+1, "/","", 0);
          exit;
        }

        $_SESSION['name'] = $name;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['password'] = $password;

        // $a = mysqli_query($connect,"select * from users where user_name = '$user_name'");
        // $rows = mysqli_query($connect,"
        //   select * from users where user_name = '$user_name'
        // ");
        // $count = mysqli_num_rows($rows);
        // var_dump($rows->fetch_assoc());
        // exit();

        // $password = md5($password);
        // mysqli_query($connect,"insert into users (user_name, password, role, full_name) VALUE ('{$user_name}', '{$password}', '{$role}', '{$full_name}')");
        // header("location:index.php?page=register");
        // setcookie("success", "Đăng ký thành công!", time()+1, "/","", 0);
    } else {
        header("location:index.php?page=register");
        exit;
    }

    $Authenticator = new Authenticator();
    if (!isset($_SESSION['auth_secret'])) {
        $secret = $Authenticator->generateRandomSecret();
        $_SESSION['auth_secret'] = $secret;
    }

    $qrCodeUrl = $Authenticator->getQR('banking_demo_local', $_SESSION['auth_secret']);
    
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
                        <?php if ($_SESSION['failed']): ?>
                            <div class="alert alert-danger" role="alert">
                                        <strong>Oh snap!</strong> Invalid Code.
                            </div>
                            <?php   
                                $_SESSION['failed'] = false;
                            ?>
                        <?php endif ?>
                            <img style="text-align: center;;" class="img-fluid" src="<?php   echo $qrCodeUrl ?>" alt="Verify this Google Authenticator"><br><br>        
                            <input type="text" class="form-control" name="code" placeholder="******" style="font-size: xx-large;width: 200px;border-radius: 0px;text-align: center;display: inline;color: #0275d8;"><br> <br>    
                            <button type="submit" class="btn btn-md btn-primary" style="width: 200px;border-radius: 0px;">Verify</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>