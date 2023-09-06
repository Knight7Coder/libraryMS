<?php
session_start();

if (isset($_SESSION['lname'])) {
    unset($_SESSION['lname']);
    header("location:http://localhost/libraryMS/");

}
if (isset($_SESSION['search'])){
    unset($_SESSION['search']);
}

?>