<?php
include "db_conn.php";
if (isset($_GET['deleteid'])) {
    $id = $_GET['deleteid'];

    $query = "DELETE FROM books WHERE id = $id";
    $res = mysqli_query($conn, $query);

}
header("location:http://localhost/libraryMS/admin/adminView.php");




?>