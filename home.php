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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-lg-5">
                <a class="navbar-brand" href="#!">ADMIN PAGE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Admin page</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">User page</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php if (!isset($_GET["page"]) || isset($_GET["page"]) && $_GET["page"] == "admin_page") {?>
            <div style="padding: 15px;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'connect_DB.php';
                            $connect = OpenCon();
                            mysqli_set_charset($connect,"utf8");
                            $rows = mysqli_query($connect, "select * from users ");
                            foreach ($rows as $row) { 
                        ?>
                            <tr>
                                <th scope="row"><?php echo $row['id'] ?></th>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['user_name'] ?></td>
                                <td><?php echo $row['amount'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success" onclick="editAmount(<?php echo $row['id'] ?>, <?php echo $row['amount'] ?>)">
                                        <i class="bi bi-pencil mr-2"></i> Edit
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <form action="" method="POST" id="formUpdate">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Amount</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input id="id" name="id" hidden> 
                                    <input class="form-control" id="amount" name="amount">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
                                    <button type="submit" name="updateUser" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } else { ?>
            <!-- Header-->
            <header class="py-5">
                <div class="container px-lg-5">
                    <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                        <div class="m-4 m-lg-5">
                            <h1 class="display-5 fw-bold">A warm welcome!</h1>
                            <p class="fs-4">Bootstrap utility classes are used to create this jumbotron since the old component has been removed from the framework. Why create custom CSS when you can use utilities?</p>
                            <a class="btn btn-primary btn-lg" href="#!">Call to action</a>
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
                                    <h2 class="fs-4 fw-bold">Fresh new layout</h2>
                                    <p class="mb-0">With Bootstrap 5, we've created a fresh new layout for this template!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xxl-4 mb-5">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-cloud-download"></i></div>
                                    <h2 class="fs-4 fw-bold">Free to download</h2>
                                    <p class="mb-0">As always, Start Bootstrap has a powerful collectin of free templates.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xxl-4 mb-5">
                            <div class="card bg-light border-0 h-100">
                                <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-card-heading"></i></div>
                                    <h2 class="fs-4 fw-bold">Jumbotron hero header</h2>
                                    <p class="mb-0">The heroic part of this template is the jumbotron hero header!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
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
</script>
<?php
    if (isset($_POST["updateUser"])) {
        $amount = $_POST["amount"];
        $id = $_POST['id'];
        $rows = mysqli_query($connect, "update users set amount = '$amount' where id ='$id'");
        CloseCon($connect);
        header("Refresh:0");
    }
?>
