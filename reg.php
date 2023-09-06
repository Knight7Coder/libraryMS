<?php
include "db_conn.php";



if (isset($_POST['register'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($password,PASSWORD_DEFAULT);
    echo $password;
    $name = $_POST['name'];
    $address = $_POST['address'];
    $mobile_num = $_POST['mobile_num'];
    $role = $_POST['role'];
    $id_num = $_POST['id_num'];

    $query = $conn->prepare("INSERT INTO registrations(Email,Password,Name,Address,Mobile_Number,Role,Id_number) VALUES(?,?,?,?,?,?,?)");
    $query->bind_param('ssssisi',$email,$password,$name,$address,$mobile_num,$role,$id_num);
    $res = $query->execute();
    // $res = mysqli_query($conn, $query);

    if ($res) {
    echo "<br>" . "Suceesfully registered";
} else {
    echo "error";
}
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="./css/regStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</head>

<body>

    <div class="container"  >
        
        <form class="row g-4 form" method="post" autocomplete="off">
            <h2 class="header"> User Registration</h2>
            <div class="col-md-6">
                <label for="inputEmail" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Enter your Email"
                    required>
            </div>
            <div class="col-md-6">
                <label for="inputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="inputPassword"
                    placeholder="Enter your Password" required>
            </div>
            <div class="col-12 ">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control " id="inputName" name="name" placeholder="Enter your Full Name"
                    required>
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="address"
                    placeholder="Enter your Address" required>
            </div>
            <div class="col-md-6">
                <label for="inputNumber" class="form-label">Mobile Number</label>
                <input type="number" class="form-control" id="inputNumber" name="mobile_num"
                    placeholder="Enter your Mobile Number" required>
            </div>
            <div class="col-md-4">
                <label for="inputRole" class="form-label">Select Role</label>
                <select id="inputRole" class="form-select" name="role" required>
                    <option selected>Choose...</option>
                    <option>Admin</option>
                    <option>Student</option>

                </select>
            </div>
            <div class="col-md-2">
                <label for="inputIdNum" class="form-label">Student/Admin ID </label>
                <input type="text" class="form-control" id="inputIdNum" name="id_num" placeholder="Enter your Id"
                    required>
            </div>

            <div class="col-12">
                <button type="submit" name="register" class="btn btn-primary">Register</button>
            </div>
        </form>

    </div>



</body>

</html>