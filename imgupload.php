<?php include "addBook.php";

if (isset($_POST['addBook']) && isset($_FILES['imgFileName'])) {
    echo '<pre>';
    print_r($_FILES['imgFileName']);
    '</pre>';
}