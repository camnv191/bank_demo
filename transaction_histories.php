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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container px-lg-5">
            <a class="navbar-brand" href="#!">USER PAGE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="home.php?page=admin_page">User page</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="padding: 15px;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Account Number</th>
                    <th scope="col">Repicient Name</th>
                    <th scope="col">Content</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Create at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include 'connect_DB.php';
                    session_start();
                    $connect = OpenCon();
                    mysqli_set_charset($connect,"utf8");
                    $rows = mysqli_query($connect, "select * from transaction_history where user_id = '{$_SESSION['user_id']}'");
                    foreach ($rows as $row) { 
                ?>
                    <tr>
                        <td><?php echo $row['account_number'] ?></td>
                        <td><?php echo $row['Recipient_name'] ?></td>
                        <td><?php echo $row['content'] ?></td>
                        <td><?php echo $row['amount_of_money'] ?></td>
                        <td><?php echo $row['create_at'] ?></td>
                        <td>
                            <button type="button" class="btn btn-success" 
                                    onclick="show_bill(<?php echo $row['account_number'] ?>, '<?php echo $row['Recipient_name'] ?>', '<?php echo $row['content'] ?>', '<?php echo $row['create_at'] ?>', <?php echo $row['amount_of_money'] ?>)">
                                <i class="bi bi-pencil mr-2"></i> Show bill
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20vh" class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="" method="POST">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal4()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row">
                        <div class="row">
                            <div class="col-md-6">ID:</div>
                            <div class="col-md-6 text-right" id="bill_id"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Recipient name:</div>
                            <div class="col-md-6 text-right" id="bill_nuser"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Account number:</div>
                            <div class="col-md-6 text-right" id="number"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Content:</div>
                            <div class="col-md-6 text-right" id="bill_content"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Amount:</div>
                            <div class="col-md-6 text-right" id="bill_amount"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Create_at:</div>
                            <div class="col-md-6 text-right" id="bill_date"></div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal4()">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script>
        function show_bill(account_number, recipient_name, content, create_at, amount) {
            $("#exampleModal4").addClass("show");
            $("#exampleModal4").css("display", "block");
            $("#bill_id")[0].innerText = 1;
            $("#bill_nuser")[0].innerText = recipient_name;
            $("#number")[0].innerText = account_number;
            $("#bill_content")[0].innerText = content;
            $("#bill_amount")[0].innerText = amount;
            $("#bill_date")[0].innerText = create_at;
        }

        function closeModal4() {
            $("#exampleModal4").removeClass("show");
            $("#exampleModal4").css("display", "none");
        }
    </script>