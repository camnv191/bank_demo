<?php
    include 'connect_DB.php';
    $connect = OpenCon();
    session_start();

    if ($_SESSION['loged'] != true) {
        header("location:index.php?page=login");
        exit;
    }
    if (isset($_POST["updateUser"])) {
        $amount = $_POST["amount"];
        $id = $_POST['id'];
        $rows = mysqli_query($connect, "update users set amount = '$amount' where id ='$id'");
        CloseCon($connect);
        header("Refresh:0");
        die;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title></title>
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>
    <body>
        <?php if ($_SESSION['role'] == 'admin') {
            include "admin_page.php";
         } else {
            include "user_page.php";
        } ?>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
<script>
    function editAmount(id, amount) {
        $("#exampleModal").addClass("show");
        $("#exampleModal").css("display", "block");
        $("#amount").val(amount);
        $("#id").val(id);
    }

    function closeModal() {
        $("#exampleModal").removeClass("show");
        $("#exampleModal").css("display", "none");
    }

    function closeModal2() {
        $("#exampleModal2").removeClass("show");
        $("#exampleModal2").css("display", "none");
    }

    function tranfer() {
        $("#exampleModal2").addClass("show");
        $("#exampleModal2").css("display", "block");
    }
</script>
