<?php
session_start();

if (isset($_SESSION['lname']) && $_SESSION['lrole'] == "Admin") {
    ?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
    </head>

    <body>
        <div class="container mt-5">
            <h1 class="text-center mb-5  ">BOOKS IN LIBRARY</h1>
            <a class="btn btn-primary me-3" href="http://localhost/libraryMS/">Home</a>
            <a class="btn btn-warning me-3" href="http://localhost/libraryMS/addBook.php">Add Book</a>

            <button class="me-4 btn btn-outline-danger ">Welcome,
                <?= $_SESSION['lname']; ?>
            </button>
            <table class="table">

                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Book Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">ISBN</th>
                        <th class="text-center" scope="col">Quantity</th>
                        <th scope="col">Operation</th>

                    </tr>
                </thead>
                <?php include "../db_conn.php";



                $query = "SELECT * FROM books";

                $res = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($res)) {

                    ?>
                    <tbody class="text-center">

                        <tr>

                            <th scope="row">
                                <?= $row['id'] ?>
                            </th>
                            <td  style = "max-width:120px;">
                                <?= $row['bookTitle'] ?>
                            </td>
                            <td>
                                <?= $row['author'] ?>
                            </td>
                            <td>
                                <?= $row['isbn'] ?>
                            </td>
                            <td>
                                <?= $row['quantity'] ?>
                            </td>
                            <td><a class="btn btn-primary me-3" name="update"
                                    href="http://localhost/libraryMS/updateBook.php?updateid=<?= $row['id'] ?>.">Update</a>
                                <a class="btn btn-danger"
                                    href="http://localhost/libraryMS/deleteBook.php?deleteid=<?= $row['id'] ?>.">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    <?php } else {
    header("location:http://localhost/libraryMS/login.php");
} ?>

</body>

</html>