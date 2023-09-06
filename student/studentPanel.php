<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5  ">MY BOOKS</h1>
     
        <table class="table">

            <thead class="text-center">
                <tr >
                    <th scope="col">#</th>
                    <th scope="col">Book Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">ISBN</th>
                    <th class="text-center" scope="col">Quantity</th>
                    <th scope="col">Details</th>

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
                        <td>
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
                        <td ><a class="btn btn-primary me-3" name = "view" href="http://localhost/libraryMS/updateBook.php?updateid=<?= $row['id'] ?>." >View</a>

                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>
</body>

</html>