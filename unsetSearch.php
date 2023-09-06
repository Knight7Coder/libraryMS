<?php
session_start();

if (isset($_SESSION['search'])){
    unset($_SESSION['search']);
}
header("location:http://localhost/libraryMS/");

?>