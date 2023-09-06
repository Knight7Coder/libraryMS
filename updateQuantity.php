<?php
include "db_conn.php";


if (isset($_GET['returnid'])) {
    $id = $_GET['returnid'];
    $q = "SELECT quantity FROM books WHERE id = '$id'";
    $r = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($r);
    echo $row['quantity'];
    $quantity = $row['quantity'];
    $query = "UPDATE books set quantity = '$quantity' + 1 WHERE id = '$id'";
    $res = mysqli_query($conn, $query);
    if ($res) {
        header("location:http://localhost/libraryMS/viewDetails.php?viewid=$id");
    }

    // if($res){
    //     echo $quantity;
    // }
} else if (isset($_GET['borrowid'])) {
    $id = $_GET['borrowid'];
    $q = "SELECT quantity FROM books WHERE id = '$id'";
    $r = mysqli_query($conn, $q);
    $row = mysqli_fetch_assoc($r);
    echo $row['quantity'];
    $quantity = $row['quantity'];
    if ($quantity > 0) {
        $query = "UPDATE books set quantity = '$quantity' - 1 WHERE id = '$id'";
        $res = mysqli_query($conn, $query);
    }
    header("location:http://localhost/libraryMS/viewDetails.php?viewid=$id");


}

?>