<?php 
    include 'connect_DB.php';
    $connect = OpenCon();

    $id = $_POST['id'];
    $rows = mysqli_query($connect, "select * from users where id = '$id' ");
    if (mysqli_num_rows($rows) > 0) {
        $row =  $rows->fetch_assoc();
        $name = $row['name'];
    } else {
        $name = null;
    }
    echo json_encode($name);
    CloseCon($connect);

?>