<?php
    require "Authenticator.php";
    include 'connect_DB.php';
    session_start();
    $connect = OpenCon();
    mysqli_set_charset($connect,"utf8");

    if ($_SERVER['REQUEST_METHOD'] != "POST") {
        if (isset($_POST["confirm_login"])) {
            header("location: index.php?page=login");
        } else {
            header("location: index.php?page=register");
        }
        die();
    }
    $Authenticator = new Authenticator();

    $checkResult = $Authenticator->verifyCode($_SESSION['auth_secret'], $_POST['code'], 2);    // 2 = 2*30sec clock tolerance

    if (!$checkResult) {
        $_SESSION['failed'] = true;
        if (isset($_POST["confirm_login"])) {
            header("location: index.php?page=login");
        } else {
            header("location: index.php?page=register");
        } 
        setcookie("error", "google code is not found", time()+1, "/","", 0);
        die();
    }

    if ($_SESSION['login'] == true) {
        unset($_SESSION['login']);
        $_SESSION['loged'] = true;
        header("location:home.php");
    } else {
        $password = md5($_SESSION['password']);
        mysqli_query($connect,"insert into users (user_name, password, role, name, status, google_code) VALUE ('{$_SESSION['user_name']}', '{$password}', 'user', '{$_SESSION['name']}', 0, '{$_POST['code']}')");

        unset($_SESSION['name']);
        unset($_SESSION['user_name']);
        unset($_SESSION['password']);
        header("location:index.php?page=login");
        setcookie("success", "User registration successful", time()+1, "/","", 0);
        CloseCon($connect);
    }
?>