<?php
session_start();
include "db_conn.php";

if (isset($_POST['signIn']) && (!empty($_POST['email']) && !empty($_POST['password']))) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['gridRadios'];


    $query = $conn->prepare("SELECT Name,Email, Password, Role from registrations where Email = ? and Role = ?");
    $query->bind_param("ss", $email, $role);
    // echo $query;
    $query->execute();
    
    
    // $row = mysqli_fetch_assoc($res);
    $query->bind_result($db_name,$db_email, $db_password, $db_role);

    $query->fetch();
    $res = password_verify( $password,$db_password);
    
    
    // echo '<pre>';
    // print_r($passwords);
    // echo '</pre>';
    if ($role == 'Admin' && $res) {
        echo $res;
        $_SESSION['lname'] = $db_name;
        $_SESSION['lrole'] = $db_role;
        header("Location:http://localhost/libraryMS/admin/adminView.php");




    } elseif ($role == 'Student' && $res) {
        
        $_SESSION['lname'] = $db_name;
        $_SESSION['lrole'] = $db_role;

        header("Location:http://localhost/libraryMS");




    }
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container d-flex min-vh-100  justify-content-center align-items-center">
        <form class="p-5 rounded" style="background-color:#CAEDFF;box-shadow: 5px 10px 8px #888888" method="post">
            <h2 class="mb-4">Log in</h2>
            <div class="row mb-3">
                <label for="inputEmail" class="col-form-label">Email</label>
                <div class="col-sm-12">
                    <input type="email" name="email" class="form-control" id="inputEmail3">
                </div>
            </div>
            
            <div class="row mb-3">
                <label for="inputPassword3" class="col-form-label">Password</label>
                <div class="col-sm-12">
                    <input type="password" name="password" class="form-control" id="inputPassword3">
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">ROLE</legend>
                <div class="col-sm-12">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Student"
                            checked>
                        <label class="form-check-label" for="gridRadios1">
                            Student
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Admin">
                        <label class="form-check-label" for="gridRadios2">
                            Admin
                        </label>
                    </div>

                </div>
            </fieldset>
            <button type="submit" name="signIn" class="btn btn-primary">Log in</button>
        </form>
    </div>
</body>

</html>