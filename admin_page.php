<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container px-lg-5">
        <a class="navbar-brand" href="#!">ADMIN PAGE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="home.php?page=admin_page">Admin page</a></li>
            </ul>
        </div>
    </div>
</nav>
<div style="padding: 15px;">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">AccountNumber</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Amount</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
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