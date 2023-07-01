<?php
    mysqli_set_charset($connect,"utf8");
    $name = $_SESSION['user_name'];
    $rows = mysqli_query($connect, "select * from users where user_name = '$name'");
    $row =  $rows->fetch_assoc();
    $amount = $row['amount'];
    if (isset($_POST["transfer"])) {
        $user_id = $_POST["user_id"];
        $account_number = $_POST['account_number'];
        $recipient_name = $_POST['recipient_name'];
        $content = $_POST['content'];
        $amount_of_money = $_POST['amount_of_money'];
        $create_at = new DateTime();

        if (!$content || !$recipient_name) {
            header("location:home.php?page=user_page");
            setcookie("error", "please enter all fields", time()+1, "/","", 0);
            exit;
        }
        if ($amount_of_money > $amount) {
            header("location:home.php?page=user_page");
            setcookie("error", "not enough money", time()+1, "/","", 0);
            exit;
        }

        date_timezone_set($create_at, timezone_open('Asia/Ho_Chi_Minh'));

        mysqli_query($connect,"insert into transaction_history (user_id, account_number, recipient_name, content, amount_of_money, create_at) VALUE ('{$user_id}', '{$account_number}', '{$recipient_name}', '{$content}', {$amount_of_money}, '{$create_at->format('Y-m-d H:i:s')}')");
        $surplus = $amount - $amount_of_money;

        mysqli_query($connect,"update users set amount = '{$surplus}' where id = '{$user_id}'");
        mysqli_query($connect,"update users set amount = amount + '{$amount_of_money}' where id = '{$account_number}'");
        header("location:home.php?page=user_page");
        setcookie("success", "Transfer successfully!", time()+1, "/","", 0);
    }
?>
<style>
    a:hover {
        text-decoration: none;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="#!">USER PAGE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="home.php?page=user_page">User page</a></li>
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?logout=logout">log_out</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- Header-->
<?php if(isset($_COOKIE["error"])) { ?>
    <div class="alert alert-danger text-center">
        <strong>'ERROR'</strong> <?php echo $_COOKIE["error"]; ?>
    </div>
<?php }; ?>
<?php if(isset($_COOKIE["success"])) { ?>
    <div class="alert alert-danger text-center">
        <strong>'SUCCESS'</strong> <?php echo $_COOKIE["success"]; ?>
    </div>
<?php }; ?>
<header class="py-5">
    <div class="container px-lg-5">
        <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-5">
                <h1 class="display-5 fw-bold">HELLO!</h1>
                <p class="fs-4"><?php echo $_SESSION['user_name'] ?></p>
                <div class='row'>
                    <a onclick="tranfer()" class="col-md-6 m-auto d-flex align-items-center justify-content-center">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 m-0"><i class="bi bi-card-heading"></i></div>
                        <strong><h5>&nbsp;&nbsp;&nbsp;Transfer money</h5></strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Page Content-->
<section class="pt-4">
    <div class="container px-lg-5">
        <!-- Page Features-->
        <div class="row gx-lg-5">
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
                        <h2 class="fs-4 fw-bold">Account balance: <?php echo $amount ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-cloud-download"></i></div>
                        <a href="transaction_histories.php"><h2 class="fs-4 fw-bold">Transaction histories</h2></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div style="margin-top: 30vh" class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="POST">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transfer money</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal2()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="id" name="user_id" value="<?php echo $row['id'] ?>" hidden>
                    <div class="form-outline form-white mb-4">
                        <input class="form-control" id="account_number" name="account_number" placeholder="account_number">
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input class="form-control" id="recipient_name" name="recipient_name" hidden>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input class="form-control" id="content" name="content" placeholder="content">
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input class="form-control" id="amount_of_money" name="amount_of_money" placeholder="amount_of_money">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal2()">Close</button>
                    <button type="submit" name="transfer" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div style="margin-top: 20vh" class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="POST">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transfer money</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal3()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php
                    mysqli_set_charset($connect,"utf8");
                    $rows = mysqli_query($connect, "select * from transaction_history where user_id = '{$_SESSION['user_id']}' order by id DESC LIMIT 1");
                    foreach ($rows as $row) { 
                ?>
                    <div class="modal-body row">
                        <div class="row">
                            <div class="col-md-6">ID:</div>
                            <div class="col-md-6 text-right" id="bill_id"><?php echo $row['ID'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Recipient name:</div>
                            <div class="col-md-6 text-right" id="bill_nuser"><?php echo $row['Recipient_name'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Account number:</div>
                            <div class="col-md-6 text-right" id="number"><?php echo $row['account_number'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Content:</div>
                            <div class="col-md-6 text-right" id="bill_content"><?php echo $row['content'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Amount:</div>
                            <div class="col-md-6 text-right" id="bill_amount"><?php echo $row['amount_of_money'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Create_at:</div>
                            <div class="col-md-6 text-right" id="bill_date"><?php echo $row['create_at'] ?></div>
                        </div>
                    </div>
                <?php } ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal3()">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $("#account_number").change(function(){
        $.ajax({
            url: 'get_user.php',
            data: {id: $('#account_number').val()},
            type: 'post',
            success: function(output) {
                debugger
                        if (output != 'null' && JSON.parse(output).length > 0) {
                            $('#recipient_name').removeAttr('hidden');
                            $('#recipient_name').val(JSON.parse(output));
                        } else {
                            $('#recipient_name').attr('hidden', 'hidden');
                            $('#recipient_name').val('');
                        }
                    }
       });
    });

    <?php if(isset($_COOKIE["success"])) { ?>
        $("#exampleModal3").addClass("show");
        $("#exampleModal3").css("display", "block");
    <?php } ?>

    function closeModal3() {
        $("#exampleModal3").removeClass("show");
        $("#exampleModal3").css("display", "none");
    }
</script>